<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;

class JobVacancyController extends Controller
{
    public function index()
    {
        $jobs = JobVacancy::where('is_active', true)->latest()->get();
        return view('career.index', compact('jobs'));
    }


    // Tambahkan method lain jika perlu (show, form, submit, dll)
    public function show($id)
    {
        $job = \App\Models\JobVacancy::where('is_active', true)->findOrFail($id);
        return view('career.show', compact('job'));
    }
}
