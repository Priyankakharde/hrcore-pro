<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveController extends Controller
{
    /**
     * Display Leave Dashboard
     */
    public function index(Request $request)
    {
        $query = Leave::query();

        // SEARCH
        if ($request->search) {
            $query->where('employee_name', 'like', '%' . $request->search . '%')
                  ->orWhere('leave_type', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%');
        }

        // STATUS FILTER
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // LEAVE TYPE FILTER
        if ($request->leave_type) {
            $query->where('leave_type', $request->leave_type);
        }

        $leaves = $query->latest()->get();

        // DASHBOARD STATS
        $totalLeaves = Leave::count();
        $approvedLeaves = Leave::where('status', 'Approved')->count();
        $pendingLeaves = Leave::where('status', 'Pending')->count();
        $rejectedLeaves = Leave::where('status', 'Rejected')->count();
        $totalDays = Leave::sum('total_days');

        return view('leaves.index', compact(
            'leaves',
            'totalLeaves',
            'approvedLeaves',
            'pendingLeaves',
            'rejectedLeaves',
            'totalDays'
        ));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store Leave
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_id'   => 'required|string|max:255',
            'leave_type'    => 'required|string',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'reason'        => 'required|string',
            'status'        => 'required|string',
        ]);

        $totalDays = Carbon::parse($request->start_date)
            ->diffInDays(Carbon::parse($request->end_date)) + 1;

        Leave::create([
            'employee_name'   => $request->employee_name,
            'employee_id'     => $request->employee_id,
            'leave_type'      => $request->leave_type,
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
            'total_days'      => $totalDays,
            'status'          => $request->status,
            'priority'        => $request->priority,
            'reason'          => $request->reason,
            'admin_note'      => $request->admin_note,
            'remaining_leave' => $request->remaining_leave ?? 20,
            'applied_date'    => now()->toDateString(),
        ]);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave request created successfully!');
    }

    /**
     * Show Single Leave
     */
    public function show(Leave $leave)
    {
        return view('leaves.show', compact('leave'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Leave $leave)
    {
        return view('leaves.edit', compact('leave'));
    }

    /**
     * Update Leave
     */
    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_id'   => 'required|string|max:255',
            'leave_type'    => 'required|string',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'reason'        => 'required|string',
            'status'        => 'required|string',
        ]);

        $totalDays = Carbon::parse($request->start_date)
            ->diffInDays(Carbon::parse($request->end_date)) + 1;

        $leave->update([
            'employee_name'   => $request->employee_name,
            'employee_id'     => $request->employee_id,
            'leave_type'      => $request->leave_type,
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
            'total_days'      => $totalDays,
            'status'          => $request->status,
            'priority'        => $request->priority,
            'reason'          => $request->reason,
            'admin_note'      => $request->admin_note,
            'remaining_leave' => $request->remaining_leave,
        ]);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave updated successfully!');
    }

    /**
     * Delete Leave
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave deleted successfully!');
    }

    /**
     * Approve Leave
     */
    public function approve(Leave $leave)
    {
        $leave->update([
            'status' => 'Approved'
        ]);

        return back()->with('success', 'Leave approved successfully!');
    }

    /**
     * Reject Leave
     */
    public function reject(Leave $leave)
    {
        $leave->update([
            'status' => 'Rejected'
        ]);

        return back()->with('success', 'Leave rejected successfully!');
    }
}
