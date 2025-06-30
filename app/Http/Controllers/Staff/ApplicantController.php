<?php


namespace App\Http\Controllers\Staff;

use App\Models\Applicant;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function index(Request $request)
    {
        $query = Applicant::with('jobVacancy')->latest('application_date');

        // Filter berdasarkan lowongan pekerjaan jika ada
        if ($request->filled('job')) {
            $query->where('job_vacancy_id', $request->job);
        }

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian jika ada
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('personal_email', 'like', "%{$search}%")
                  ->orWhere('mobile_phone', 'like', "%{$search}%");
            });
        }

        $applicants = $query->paginate(15);
        $jobs = JobVacancy::where('is_active', true)->get();

        return view('staff.applicants.index', compact('applicants', 'jobs'));
    }

    public function show(Applicant $applicant)
    {
        return view('staff.applicants.show', compact('applicant'));
    }

    public function edit(Applicant $applicant)
    {
        return view('staff.applicants.edit', compact('applicant'));
    }

    public function update(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,review,interview,passed,rejected',
            'additional_notes' => 'nullable|string',
            'interview_date' => 'nullable|date|required_if:status,interview',
            'interview_time' => 'nullable|required_if:status,interview',
            'interview_link' => 'nullable|url|required_if:interview_type,online',
            'interview_location' => 'nullable|string|required_if:interview_type,offline',
        ]);

        $applicant->update($validated);

        return redirect()->route('staff.applicants.index')->with('success', 'Data pelamar berhasil diupdate.');
    }

    public function destroy(Applicant $applicant)
    {
        // Hapus file yang terkait jika ada
        if ($applicant->cv) {
            Storage::disk('public')->delete($applicant->cv);
        }
        if ($applicant->photo) {
            Storage::disk('public')->delete($applicant->photo);
        }

        $applicant->delete();

        return redirect()->route('staff.applicants.index')->with('success', 'Data pelamar berhasil dihapus.');
    }

    public function export()
    {
        // Implementasi export ke Excel/CSV bisa ditambahkan di sini
        return redirect()->back()->with('info', 'Fitur export data sedang dalam pengembangan.');
    }
}
