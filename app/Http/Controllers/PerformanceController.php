<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Employee;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Display a listing of performances.
     */
    public function index(Request $request)
    {
        $query = Performance::with('employee');

        // Search
        if ($request->filled('search')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Rating Filter
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Department Filter
        if ($request->filled('department')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        $performances = $query->latest()->paginate(10);

        // Dashboard Statistics
        $stats = [
            'total_reviews' => Performance::count(),
            'excellent'     => Performance::where('rating', 'Excellent')->count(),
            'very_good'     => Performance::where('rating', 'Very Good')->count(),
            'good'          => Performance::where('rating', 'Good')->count(),
            'average'       => Performance::where('rating', 'Average')->count(),
            'poor'          => Performance::where('rating', 'Poor')->count(),
            'avg_score'     => round(Performance::avg('overall_score'), 2),
        ];

        return view('performance.index', compact(
            'performances',
            'stats'
        ));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();

        return view('performance.create', compact('employees'));
    }

    /**
     * Store performance.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'employee_id' => 'required|exists:employees,id',

            'review_month' => 'required',

            'review_year' => 'required',

            'attendance' => 'required|numeric|min:0|max:100',

            'task_completion' => 'required|numeric|min:0|max:100',

            'productivity' => 'required|numeric|min:0|max:100',

            'communication' => 'required|numeric|min:0|max:100',

            'teamwork' => 'required|numeric|min:0|max:100',

            'leadership' => 'required|numeric|min:0|max:100',

            'problem_solving' => 'required|numeric|min:0|max:100',

            'punctuality' => 'required|numeric|min:0|max:100',

            'discipline' => 'required|numeric|min:0|max:100',

            'innovation' => 'required|numeric|min:0|max:100',

            'learning' => 'required|numeric|min:0|max:100',

            'strengths' => 'nullable',

            'weaknesses' => 'nullable',

            'remarks' => 'nullable',

            'goals' => 'nullable',

            'improvement_plan' => 'nullable',

            'next_review_date' => 'nullable|date',

        ]);

        $score = (
            $validated['attendance'] +
            $validated['task_completion'] +
            $validated['productivity'] +
            $validated['communication'] +
            $validated['teamwork'] +
            $validated['leadership'] +
            $validated['problem_solving'] +
            $validated['punctuality'] +
            $validated['discipline'] +
            $validated['innovation'] +
            $validated['learning']
        ) / 11;

        $validated['overall_score'] = round($score, 2);

        if ($score >= 90) {
            $validated['rating'] = 'Excellent';
        } elseif ($score >= 80) {
            $validated['rating'] = 'Very Good';
        } elseif ($score >= 70) {
            $validated['rating'] = 'Good';
        } elseif ($score >= 60) {
            $validated['rating'] = 'Average';
        } else {
            $validated['rating'] = 'Poor';
        }

        Performance::create($validated);

        return redirect()
            ->route('performance.index')
            ->with('success', 'Performance review added successfully.');
    }
        /**
     * Display the specified performance.
     */
    public function show(Performance $performance)
    {
        $performance->load('employee');

        return view('performance.show', compact('performance'));
    }
    /**
     * Show the form for editing the specified performance.
     */
    public function edit(Performance $performance)
    {
        $employees = Employee::orderBy('name')->get();

        return view('performance.edit', compact(
            'performance',
            'employees'
        ));
    }

    /**
     * Update the specified performance.
     */
    public function update(Request $request, Performance $performance)
    {
        $validated = $request->validate([

            'employee_id' => 'required|exists:employees,id',

            'review_month' => 'required',

            'review_year' => 'required',

            'attendance' => 'required|numeric|min:0|max:100',

            'task_completion' => 'required|numeric|min:0|max:100',

            'productivity' => 'required|numeric|min:0|max:100',

            'communication' => 'required|numeric|min:0|max:100',

            'teamwork' => 'required|numeric|min:0|max:100',

            'leadership' => 'required|numeric|min:0|max:100',

            'problem_solving' => 'required|numeric|min:0|max:100',

            'punctuality' => 'required|numeric|min:0|max:100',

            'discipline' => 'required|numeric|min:0|max:100',

            'innovation' => 'required|numeric|min:0|max:100',

            'learning' => 'required|numeric|min:0|max:100',

            'strengths' => 'nullable',

            'weaknesses' => 'nullable',

            'remarks' => 'nullable',

            'goals' => 'nullable',

            'improvement_plan' => 'nullable',

            'next_review_date' => 'nullable|date',

        ]);

        $score = (
            $validated['attendance'] +
            $validated['task_completion'] +
            $validated['productivity'] +
            $validated['communication'] +
            $validated['teamwork'] +
            $validated['leadership'] +
            $validated['problem_solving'] +
            $validated['punctuality'] +
            $validated['discipline'] +
            $validated['innovation'] +
            $validated['learning']
        ) / 11;

        $validated['overall_score'] = round($score, 2);

        if ($score >= 90) {
            $validated['rating'] = 'Excellent';
        } elseif ($score >= 80) {
            $validated['rating'] = 'Very Good';
        } elseif ($score >= 70) {
            $validated['rating'] = 'Good';
        } elseif ($score >= 60) {
            $validated['rating'] = 'Average';
        } else {
            $validated['rating'] = 'Poor';
        }

        $performance->update($validated);

        return redirect()
            ->route('performance.index')
            ->with('success', 'Performance updated successfully.');
    }

    /**
     * Remove the specified performance.
     */
    public function destroy(Performance $performance)
    {
        $performance->delete();

        return redirect()
            ->route('performance.index')
            ->with('success', 'Performance deleted successfully.');
    }
}