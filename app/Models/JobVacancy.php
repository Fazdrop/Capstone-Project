<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    //
    protected $fillable = [
        'title',
        'department',
        'division',
        'description',
        'requirements',
        'location',
        'employment_type',
        'deadline',
        'is_active',
    ];
}
