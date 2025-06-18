<?php

namespace App\Http\Controllers\HoD;

use Illuminate\Http\Request;
use App\Models\EmployeeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeRequestController extends Controller
{
    public function index()
    {
        $requests = EmployeeRequest::with('division')
            ->where('division_id', Auth::user()->division_id)
            ->latest()
            ->get();
        return view('hod.request_employee.index', compact('requests'));
    }

    public function create()
    {
        return view('hod.request_employee.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'request_date' => 'required|date',
            'requester_name' => 'required|string|max:255',
            'business_unit_division' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'work_location' => 'required|string|max:255',
            'grade_level' => 'nullable|string|max:100',
            'employment_type' => 'required|in:contract,permanent',
            'contract_end_date' => 'nullable|date|required_if:employment_type,contract',
            'request_type' => 'required|in:new,replace',
            'replacement_reason' => 'nullable|in:resign,mutation,promotion|required_if:request_type,replace',
            'reason' => 'nullable|string',
            'gender_requirement' => 'required|in:male,female',
            'min_age_requirement' => 'nullable|integer|min:17',
            'max_age_requirement' => 'nullable|integer|min:17|gte:min_age_requirement',
            'experience_requirement' => 'required|string',
            'education_level' => 'required|array|min:1',
            'major_requirement' => 'nullable|string', // Tagify = json array string
            'job_description' => 'required|array|min:1',
            'soft_skills_requirement' => 'nullable|string', // Tagify = json array string
            'hard_skills_requirement' => 'nullable|string', // Tagify = json array string
            'supporting_documents' => 'nullable',
            'supporting_documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $validated['education_level'] = json_encode($request->input('education_level'));
        $validated['job_description'] = json_encode($request->input('job_description'));

        // Tagify fields: JSON string dari Tagify, bukan explode!
        $validated['major_requirement'] = $this->normalizeTagify($request->major_requirement);
        $validated['soft_skills_requirement'] = $this->normalizeTagify($request->soft_skills_requirement);
        $validated['hard_skills_requirement'] = $this->normalizeTagify($request->hard_skills_requirement);

        // File upload
        if ($request->hasFile('supporting_documents')) {
            $filePaths = [];
            foreach ($request->file('supporting_documents') as $file) {
                $filePaths[] = $file->store('supporting_documents', 'public');
            }
            $validated['supporting_documents'] = json_encode($filePaths);
        }

        $validated['division_id'] = Auth::user()->division_id;
        $validated['user_id'] = Auth::user()->id;
        $validated['request_number'] = 'Draft';
        $validated['workflow_status'] = 'submitted_by_user';

        EmployeeRequest::create($validated);

        return redirect()->route('hod.request_employee.index')
            ->with('success', 'Permintaan karyawan berhasil diajukan.');
    }

    public function show($id)
    {
        $request = EmployeeRequest::with(['division', 'user'])->findOrFail($id);
        return view('hod.request_employee.show', compact('request'));
    }

    public function edit($id)
    {
        $request = EmployeeRequest::findOrFail($id);

        // Cek apakah user yang login adalah pemilik request
        if ($request->user_id !== Auth::id()) {
            return redirect()->route('hod.request_employee.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit permintaan ini.');
        }

        // Status yang boleh diedit
        $editableStatuses = ['submitted_by_user', 'revisi', 'rejected'];
        $currentStatus = strtolower(str_replace(' ', '_', $request->workflow_status));
        if (!in_array($currentStatus, $editableStatuses)) {
            return redirect()->route('hod.request_employee.index')
                ->with('error', 'Permintaan ini tidak dapat diedit karena sudah dalam proses persetujuan.');
        }

        return view('hod.request_employee.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $employeeRequest = EmployeeRequest::findOrFail($id);

        // Cek izin dan status sekali lagi sebelum update
        if ($employeeRequest->user_id !== Auth::id()) {
            return redirect()->route('hod.request_employee.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengupdate permintaan ini.');
        }
        $editableStatuses = ['submitted_by_user', 'revisi', 'rejected'];
        $currentStatus = strtolower(str_replace(' ', '_', $employeeRequest->workflow_status));
        if (!in_array($currentStatus, $editableStatuses)) {
            return redirect()->route('hod.request_employee.index')
                ->with('error', 'Gagal update. Permintaan sudah dalam proses persetujuan.');
        }

        // Validasi data
        $validated = $request->validate([
            'request_date' => 'required|date',
            'requester_name' => 'required|string|max:255',
            'business_unit_division' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'work_location' => 'required|string|max:255',
            'grade_level' => 'nullable|string|max:100',
            'employment_type' => 'required|in:contract,permanent',
            'contract_end_date' => 'nullable|date|required_if:employment_type,contract',
            'request_type' => 'required|in:new,replace',
            'replacement_reason' => 'nullable|in:resign,mutation,promotion|required_if:request_type,replace',
            'reason' => 'nullable|string',
            'gender_requirement' => 'required|in:male,female,any',
            'min_age_requirement' => 'nullable|integer|min:17',
            'max_age_requirement' => 'nullable|integer|min:17|gte:min_age_requirement',
            'experience_requirement' => 'required|string',
            'education_level' => 'required|array|min:1',
            'major_requirement' => 'nullable|string',
            'job_description' => 'required|array|min:1',
            'soft_skills_requirement' => 'nullable|string',
            'hard_skills_requirement' => 'nullable|string',
            'supporting_documents' => 'nullable',
            'supporting_documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $validated['education_level'] = json_encode($request->input('education_level'));
        $validated['job_description'] = json_encode($request->input('job_description'));
        $validated['major_requirement'] = $this->normalizeTagify($request->major_requirement);
        $validated['soft_skills_requirement'] = $this->normalizeTagify($request->soft_skills_requirement);
        $validated['hard_skills_requirement'] = $this->normalizeTagify($request->hard_skills_requirement);

        // Handle file upload (jika ada file baru)
        if ($request->hasFile('supporting_documents')) {
            // Hapus file lama jika ada
            if ($employeeRequest->supporting_documents) {
                $oldFiles = json_decode($employeeRequest->supporting_documents, true) ?? [];
                foreach ($oldFiles as $oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
            $filePaths = [];
            foreach ($request->file('supporting_documents') as $file) {
                $filePaths[] = $file->store('supporting_documents', 'public');
            }
            $validated['supporting_documents'] = json_encode($filePaths);
        }

        // Reset status workflow setelah update
        $validated['workflow_status'] = 'submitted_by_user';

        $employeeRequest->update($validated);

        return redirect()->route('hod.request_employee.index')
            ->with('success', 'Permintaan karyawan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $request = EmployeeRequest::findOrFail($id);

        // Hapus file terkait jika ada
        if ($request->supporting_documents) {
            $files = json_decode($request->supporting_documents, true) ?? [];
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $request->delete();

        return redirect()->route('hod.request_employee.index')
            ->with('success', 'Permintaan karyawan berhasil dihapus.');
    }

    // === Helper Function ===
    /**
     * Jika field Tagify kosong, kembalikan json array kosong.
     * Jika isian valid json array, return as is.
     * Jika tidak valid json (misal user edit manual), tetap return json array kosong.
     */
    private function normalizeTagify($value)
    {
        if (empty($value)) return json_encode([]);
        $decoded = json_decode($value, true);
        return is_array($decoded) ? json_encode($decoded) : json_encode([]);
    }
}
