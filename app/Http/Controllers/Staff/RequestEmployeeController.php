<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeRequest;
use Illuminate\Support\Facades\Auth;

class RequestEmployeeController extends Controller
{
    public function index()
    {
        // Tampilkan hanya request yang perlu diproses staff HR (submitted_by_user atau fpk_created)
        $requests = EmployeeRequest::whereIn('workflow_status', ['submitted_by_user', 'waiting_fpk', 'fpk_created', 'waiting_manager_approval', 'approved', 'rejected'])
            ->latest()
            ->with('division') // eager load relasi division
            ->get();
        return view('staff.request_employee.index', compact('requests'));
    }

    public function show($id)
    {
        $req = EmployeeRequest::with('division')->findOrFail($id);
        return view('staff.request_employee.show', compact('req'));
    }

    public function edit($id)
    {
        $req = EmployeeRequest::with('division')->findOrFail($id);
        return view('staff.request_employee.edit', compact('req'));
    }

    public function update(Request $request, $id)
    {
        $req = \App\Models\EmployeeRequest::findOrFail($id);

        $request->validate([
            'request_number' => 'required|numeric',
        ]);

        $req->request_number = $request->request_number;
        // Jika ingin, update juga workflow_status ke 'fpk_created' di sini:
        $req->workflow_status = 'fpk_created';

        $req->save();

        return redirect()->route('staff.request_employee.index')->with('success', 'Nomor FPK berhasil diupdate!');
    }
    
    public function submitApproval($id)
    {
        $req = EmployeeRequest::findOrFail($id);
        $req->workflow_status = 'waiting_manager_approval';
        $req->save();
        return redirect()->route('staff.request_employee.index')->with('success', 'FPK diajukan ke Manager!');
    }

    public function reject($id)
    {
        $req = \App\Models\EmployeeRequest::findOrFail($id);

        // Hanya boleh reject jika status draft, submitted_by_user, waiting_fpk
        if (!in_array($req->workflow_status, ['draft', 'submitted_by_user', 'waiting_fpk'])) {
            return redirect()->back()->with('error', 'Permintaan tidak dapat direject pada status ini.');
        }
        $req->workflow_status = 'rejected';
        $req->save();

        return redirect()->route('staff.request_employee.index')->with('success', 'Permintaan berhasil direject.');
    }
}
