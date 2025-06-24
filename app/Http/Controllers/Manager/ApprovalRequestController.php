<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\EmployeeRequest;

class ApprovalRequestController extends Controller
{
    // Hanya Manager HR yang boleh lihat approval
    public function index()
    {
        $user = Auth::user();
        if (
            strtolower($user->role?->name) !== 'manager' ||
            strtolower($user->division?->name) !== 'hr'
        ) {
            abort(403, 'Akses khusus Manager HR.');
        }

        // Hanya tampilkan request yang sudah siap approval manager
        $requests = EmployeeRequest::where('workflow_status', 'waiting_manager_approval')->latest()->get();
        return view('manager.approve_request.index', compact('requests'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate(['note' => 'required|string']);

        $req = EmployeeRequest::findOrFail($id);
        $req->workflow_status = 'approved';
        $req->notes = $request->note;
        $req->save();

        return redirect()->back()->with('success', 'Permintaan disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['note' => 'required|string']);

        $req = EmployeeRequest::findOrFail($id);
        $req->workflow_status = 'rejected';
        $req->notes = $request->note;
        $req->save();

        return redirect()->back()->with('success', 'Permintaan ditolak.');
    }
}
