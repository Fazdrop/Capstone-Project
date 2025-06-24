<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    // Tampilkan form apply
    public function form($jobVacancyId)
    {
        $job = JobVacancy::where('is_active', true)->findOrFail($jobVacancyId);
        return view('career.apply', compact('job'));
    }

    // Proses submit lamaran
    public function submit(Request $request, $jobVacancyId)
    {
        $job = JobVacancy::where('is_active', true)->findOrFail($jobVacancyId);

        // Validasi input
        $validated = $request->validate([
            'full_name'           => 'required|string|max:255',
            'nickname'            => 'nullable|string|max:100',
            'birth_place'         => 'nullable|string|max:100',
            'birth_date'          => 'nullable|date',
            'gender'              => 'nullable|in:M,F',
            'marital_status'      => 'nullable|string|max:50',
            'ktp_address'         => 'nullable|string',
            'current_address'     => 'nullable|string',
            'emergency_contact_1' => 'nullable|string|max:100',
            'emergency_contact_2' => 'nullable|string|max:100',
            'religion'            => 'nullable|string|max:50',
            'nationality'         => 'nullable|string|max:50',
            'blood_type'          => 'nullable|string|max:5',
            'national_id'         => 'required|string|max:32',
            'tax_id'              => 'nullable|string|max:32',
            'last_education'      => 'nullable|string|max:100',
            'institution_name'    => 'nullable|string|max:100',
            'major'               => 'nullable|string|max:100',
            'entry_year'          => 'nullable|digits:4|integer',
            'graduation_year'     => 'nullable|digits:4|integer',
            'gpa'                 => 'nullable|numeric|between:0,4.00',
            'company_name'        => 'nullable|string|max:100',
            'position'            => 'nullable|string|max:100',
            'work_period'         => 'nullable|string|max:50',
            'job_description'     => 'nullable|string',
            'reason_for_leaving'  => 'nullable|string',
            'technical_skills'    => 'nullable|string',
            'non_technical_skills' => 'nullable|string',
            'expected_salary'     => 'nullable|string', //ganti jadi string, karena menerima string
            'reference'           => 'nullable|string|max:100',
            'hobby'               => 'nullable|string|max:100',
            'applied_position'    => 'nullable|string|max:100',
            'cv_file_name'        => 'nullable|string|max:255',
            'photo_file_name'     => 'nullable|string|max:255',
            'application_date'    => 'nullable|date',
            'home_phone'          => 'nullable|string|max:20',
            'mobile_phone'        => 'nullable|string|max:20',
            'personal_email'      => 'required|email|max:255',
            'cv'                  => 'nullable|file|mimes:pdf|max:2048',
            'photo'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cek apakah sudah pernah apply untuk lowongan ini
        $exists = Applicant::where('job_vacancy_id', $job->id)
            ->where(function ($q) use ($request) {
                $q->where('personal_email', $request->personal_email)
                    ->orWhere('national_id', $request->national_id);
            })
            ->exists();

        if ($exists) {
            return redirect()->route('career.index')->with('info', 'You have already applied for this job.');
        }

        // Hitung jumlah lamaran tahun ini berdasarkan NIK/email
        $year = now()->year;
        $applicationsThisYear = Applicant::where(function ($q) use ($request) {
            $q->where('personal_email', $request->personal_email)
                ->orWhere('national_id', $request->national_id);
        })
            ->whereYear('application_date', $year)
            ->count();

        if ($applicationsThisYear >= 2) {
            return redirect()->route('career.index')->with('info', 'You have reached the maximum number of applications for this year.');
        }

        $validated['job_vacancy_id'] = $job->id;
        $validated['application_date'] = now();

        // Handle file upload jika ada
        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('cv', 'public');
        }
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photo', 'public');
        }

        //untuk mengembalikan string ke integer agar menyesuaikan database yang di set integer
        $validated['expected_salary'] = $request->expected_salary
            ? (int) str_replace('.', '', $request->expected_salary)
            : null;


        Applicant::create($validated);

        return redirect()->route('career.index')->with('success', 'Your application has been submitted!');
    }
}
