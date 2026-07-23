<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display Projects
     */
    public function index(Request $request)
    {
        $query = Project::query();

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('project_name', 'like', '%' . $request->search . '%')
                  ->orWhere('client_name', 'like', '%' . $request->search . '%')
                  ->orWhere('project_code', 'like', '%' . $request->search . '%');

            });

        }

        // Status Filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // Priority Filter
        if ($request->filled('priority')) {

            $query->where('priority', $request->priority);

        }

        $projects = $query
            ->latest()
            ->paginate(10);

        return view('projects.index', [

            'projects' => $projects,

            'totalProjects' => Project::count(),

            'activeProjects' => Project::where('status', 'Active')->count(),

            'completedProjects' => Project::where('status', 'Completed')->count(),

            'pendingProjects' => Project::where('status', 'Pending')->count(),

            'onHoldProjects' => Project::where('status', 'On Hold')->count(),
            
            'totalBudget' => Project::sum('budget'),

        ]);    
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('projects.create');
    }
        /**
     * Store Project
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'project_name' => 'required|string|max:255',
            'project_code' => 'required|string|max:100|unique:projects',
            'client_name' => 'required|string|max:255',
            'project_manager' => 'required|string|max:255',
            'team_members' => 'nullable|string',

            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'completed_date' => 'nullable|date',

            'budget' => 'required|numeric',
            'spent_amount' => 'nullable|numeric',

            'priority' => 'required|string',
            'status' => 'required|string',

            'progress' => 'nullable|integer',

            'department' => 'nullable|string',
            'technology' => 'nullable|string',
            'project_type' => 'nullable|string',

            'total_tasks' => 'nullable|integer',
            'completed_tasks' => 'nullable|integer',
            'team_size' => 'nullable|integer',

            'description' => 'nullable|string',

            'attachment' => 'nullable|file|max:5120',

        ]);

        if ($request->hasFile('attachment')) {

            $validated['attachment'] = $request
                ->file('attachment')
                ->store('projects', 'public');

        }

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display Project
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
        /**
     * Update Project
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([

            'project_name' => 'required|string|max:255',
            'project_code' => 'required|string|max:100|unique:projects,project_code,' . $project->id,
            'client_name' => 'required|string|max:255',
            'project_manager' => 'required|string|max:255',
            'team_members' => 'nullable|string',

            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'completed_date' => 'nullable|date',

            'budget' => 'required|numeric',
            'spent_amount' => 'nullable|numeric',

            'priority' => 'required|string',
            'status' => 'required|string',

            'progress' => 'nullable|integer',

            'department' => 'nullable|string',
            'technology' => 'nullable|string',
            'project_type' => 'nullable|string',

            'total_tasks' => 'nullable|integer',
            'completed_tasks' => 'nullable|integer',
            'team_size' => 'nullable|integer',

            'description' => 'nullable|string',

            'attachment' => 'nullable|file|max:5120',

        ]);

        if ($request->hasFile('attachment')) {

            if (
                $project->attachment &&
                Storage::disk('public')->exists($project->attachment)
            ) {
                Storage::disk('public')->delete($project->attachment);
            }

            $validated['attachment'] = $request
                ->file('attachment')
                ->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Delete Project
     */
    public function destroy(Project $project)
    {
        if (
            $project->attachment &&
            Storage::disk('public')->exists($project->attachment)
        ) {
            Storage::disk('public')->delete($project->attachment);
        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
        /**
     * Mark Project as Completed
     */
    public function complete(Project $project)
    {
        $project->update([
            'status' => 'Completed',
            'progress' => 100,
            'completed_date' => now(),
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project marked as completed.');
    }

    /**
     * Put Project On Hold
     */
    public function hold(Project $project)
    {
        $project->update([
            'status' => 'On Hold',
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project is now on hold.');
    }

    /**
     * Restart Project
     */
    public function restart(Project $project)
    {
        $project->update([
            'status' => 'Active',
            'completed_date' => null,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project restarted successfully.');
    }
}