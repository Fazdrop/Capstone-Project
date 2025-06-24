<?php


namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobVacancy::latest()->get();
        return view('staff.job_vacancy.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.job_vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'is_active' => 'required|boolean',
        ]);
        JobVacancy::create($validated);
        return redirect()->route('staff.job_vacancy.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('staff.job_vacancy.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('staff.job_vacancy.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'is_active' => 'required|boolean',
        ]);
        $job = JobVacancy::findOrFail($id);
        $job->update($validated);
        return redirect()->route('staff.job_vacancy.index')->with('success', 'Lowongan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = JobVacancy::findOrFail($id);
        $job->delete();
        return redirect()->route('staff.job_vacancy.index')->with('success', 'Lowongan berhasil dihapus!');

    }
}
