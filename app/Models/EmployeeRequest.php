<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeRequest extends Model
{
    //
    protected $fillable = [
        'division_id',
        'request_number',
        'request_date',
        'requester_name',
        'business_unit_division',
        'department',
        'position',
        'quantity',
        'work_location',
        'grade_level',
        'employment_type',
        'contract_end_date',
        'request_type',
        'replacement_reason',
        'reason',
        'gender_requirement',
        'min_age_requirement',
        'max_age_requirement',
        'experience_requirement',
        'additional_requirements',
        'required_date',
        'job_type',
        'special_criteria',
        'education_level',
        'major_requirement',
        'job_description',
        'soft_skills_requirement',
        'hard_skills_requirement',
        'supporting_documents',
        'workflow_status',
        'suggested_tasks_and_responsibilities',
        'notes',
    ];

    protected $casts = [
        'request_date' => 'date',
        'contract_end_date' => 'date',
        'required_date' => 'date',
    ];


    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
