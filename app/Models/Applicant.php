<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_vacancy_id',
        'full_name',
        'nickname',
        'birth_place',
        'birth_date',
        'gender',
        'marital_status',
        'ktp_address',
        'current_address',
        'emergency_contact_1',
        'emergency_contact_2',
        'religion',
        'nationality',
        'blood_type',
        'national_id',
        'tax_id',
        'last_education',
        'institution_name',
        'major',
        'entry_year',
        'graduation_year',
        'gpa',
        'company_name',
        'position',
        'work_period',
        'job_description',
        'reason_for_leaving',
        'technical_skills',
        'non_technical_skills',
        'expected_salary',
        'reference',
        'hobby',
        'applied_position',
        'cv_file_name',
        'photo_file_name',
        'application_date',
        'home_phone',
        'mobile_phone',
        'personal_email',
        'cv',
        'photo',
        //disi oleh staff HR
        'status',
        'interview_date',
        'interview_time',
        'interview_link',
        'interview_location',
        'additional_notes',
    ];

    public function jobVacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class);
    }
}
