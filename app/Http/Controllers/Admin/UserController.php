<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['division', 'role'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $divisions = Division::all();
        $roles = Role::all();
        return view('admin.users.create', compact('divisions', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'division_id' => 'required|exists:divisions,id',
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
        ]);

        // Ambil nama divisi dan role dari database
        $division = \App\Models\Division::find($validated['division_id']);
        $role = \App\Models\Role::find($validated['role_id']);

        // Cek konsistensi: jika divisi admin/bod, role harus admin/bod juga
        if (
            (strtolower($division->name) === 'admin' && strtolower($role->name) !== 'admin') ||
            (strtolower($division->name) === 'bod' && strtolower($role->name) !== 'bod')
        ) {
            return back()->withErrors(['role_id' => 'Role tidak sesuai dengan divisi yang dipilih.'])->withInput();
        }

        // Selain admin/bod, role tidak boleh admin/bod
        if (
            strtolower($division->name) !== 'admin' && strtolower($division->name) !== 'bod' &&
            (strtolower($role->name) === 'admin' || strtolower($role->name) === 'bod')
        ) {
            return back()->withErrors(['role_id' => 'Role tidak sesuai dengan divisi yang dipilih.'])->withInput();
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $divisions = Division::all();
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'divisions', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'division_id' => 'required|exists:divisions,id',
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
            'password' => 'nullable|string|min:6',
        ]);

        $division = \App\Models\Division::find($validated['division_id']);
        $role = \App\Models\Role::find($validated['role_id']);

        if (
            (strtolower($division->name) === 'admin' && strtolower($role->name) !== 'admin') ||
            (strtolower($division->name) === 'bod' && strtolower($role->name) !== 'bod')
        ) {
            return back()->withErrors(['role_id' => 'Role tidak sesuai dengan divisi yang dipilih.'])->withInput();
        }

        if (
            strtolower($division->name) !== 'admin' && strtolower($division->name) !== 'bod' &&
            (strtolower($role->name) === 'admin' || strtolower($role->name) === 'bod')
        ) {
            return back()->withErrors(['role_id' => 'Role tidak sesuai dengan divisi yang dipilih.'])->withInput();
        }

        // Password optional saat edit
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
