<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all(); // var $divisions (jamak)
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:divisions,name',
        ]);

        // Pastikan name selalu lowercase!
        $validated['name'] = strtolower($validated['name']);

        Division::create($validated);
        return redirect()->route('admin.divisions.index')->with('success', 'Division berhasil dibuat!');
    }

    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|unique:divisions,name,' . $division->id,
        ]);
        // Pastikan name selalu lowercase!
        $validated['name'] = strtolower($validated['name']);


        $division->update($validated);
        return redirect()->route('admin.divisions.index')->with('success', 'Division berhasil diupdate!');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('admin.divisions.index')->with('success', 'Division berhasil dihapus!');
    }
}
