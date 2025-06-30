<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function index(Request $request)
    {
        $query = JobVacancy::query()->where('is_active', true);

        // Filter berdasarkan departemen (sebagai string, bukan ID)
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Filter berdasarkan lokasi
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Filter berdasarkan kata kunci
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('requirements', 'like', "%{$search}%");
            });
        }

        $jobs = $query->latest()->paginate(12);

        // Get distinct locations for filter dropdown
        $locations = JobVacancy::where('is_active', true)
            ->distinct()
            ->pluck('location')
            ->toArray();

        // Get distinct departments as strings (not as IDs)
        $departments = JobVacancy::where('is_active', true)
            ->distinct()
            ->pluck('department')
            ->filter() // Remove empty values
            ->map(function ($dept) {
                return (object) ['id' => $dept, 'name' => $dept];
            })
            ->values();

        return view('career.index', compact('jobs', 'locations', 'departments'));
    }

    // Jika Anda memiliki method show
    public function show($id)
    {
        $job = JobVacancy::where('is_active', true)->findOrFail($id);
        return view('career.show', compact('job'));
    }
}
