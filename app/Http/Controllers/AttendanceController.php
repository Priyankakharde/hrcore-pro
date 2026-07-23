<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display Attendance Dashboard
     */
    public function index(Request $request)
    {
        $query = Attendance::with('employee');

        // Search Employee
        if ($request->filled('search')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('employee_id', 'like', '%' . $request->search . '%');
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date Filter
        if ($request->filled('date')) {
            $query->whereDate('attendance_date', $request->date);
        }

        $attendances = $query
            ->latest('attendance_date')
            ->paginate(10)
            ->withQueryString();

        // Dashboard Statistics
        $totalEmployees = Employee::count();

        $presentToday = Attendance::whereDate('attendance_date', today())
            ->where('status', 'Present')
            ->count();

        $absentToday = Attendance::whereDate('attendance_date', today())
            ->where('status', 'Absent')
            ->count();

        $leaveToday = Attendance::whereDate('attendance_date', today())
            ->where('status', 'Leave')
            ->count();

        $attendanceRate = $totalEmployees > 0
            ? round(($presentToday / $totalEmployees) * 100)
            : 0;

        return view('attendance.index', compact(
            'attendances',
            'totalEmployees',
            'presentToday',
            'absentToday',
            'leaveToday',
            'attendanceRate'
        ));
    }

    /**
     * Show Attendance Form
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();

        return view('attendance.create', compact('employees'));
    }
        /**
     * Store Attendance
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id'      => 'required|exists:employees,id',
            'attendance_date'  => 'required|date',
            'check_in'         => 'nullable|date_format:H:i',
            'check_out'        => 'nullable|date_format:H:i|after:check_in',
            'shift'            => 'required',
            'status'           => 'required',
            'location'         => 'nullable|string|max:255',
            'notes'            => 'nullable|string|max:1000',
        ]);

        // Prevent Duplicate Attendance
        $exists = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('attendance_date', $request->attendance_date)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Attendance has already been marked for this employee.');
        }

        // Calculate Working Hours
        $workingHours = 0;
        $overtime = 0;

        if ($request->check_in && $request->check_out) {

            $checkIn = strtotime($request->check_in);
            $checkOut = strtotime($request->check_out);

            $workingHours = round(($checkOut - $checkIn) / 3600, 2);

            if ($workingHours > 8) {
                $overtime = $workingHours - 8;
            }
        }

        Attendance::create([
            'employee_id'      => $request->employee_id,
            'attendance_date'  => $request->attendance_date,
            'check_in'         => $request->check_in,
            'check_out'        => $request->check_out,
            'working_hours'    => $workingHours,
            'overtime_hours'   => $overtime,
            'break_hours'      => 1,
            'shift'            => $request->shift,
            'status'           => $request->status,
            'location'         => $request->location,
            'device'           => request()->userAgent(),
            'ip_address'       => request()->ip(),
            'notes'            => $request->notes,
            'created_by'       => auth()->id(),
        ]);

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance marked successfully.');
    }

    /**
     * Show Attendance Details
     */
    public function show(Attendance $attendance)
    {
        $attendance->load('employee');

        return view('attendance.show', compact('attendance'));
    }

    /**
     * Edit Attendance
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('name')->get();

        return view('attendance.edit', compact(
            'attendance',
            'employees'
        ));
    }
        /**
     * Update Attendance
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'shift' => 'required|string',
            'status' => 'required|string',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Calculate Working Hours
        $workingHours = 0;
        $overtime = 0;

        if ($request->check_in && $request->check_out) {

            $checkIn = strtotime($request->check_in);
            $checkOut = strtotime($request->check_out);

            $workingHours = round(($checkOut - $checkIn) / 3600, 2);

            if ($workingHours > 8) {
                $overtime = round($workingHours - 8, 2);
            }
        }

        $attendance->update([
            'employee_id' => $request->employee_id,
            'attendance_date' => $request->attendance_date,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'working_hours' => $workingHours,
            'overtime_hours' => $overtime,
            'shift' => $request->shift,
            'status' => $request->status,
            'location' => $request->location,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Delete Attendance
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}