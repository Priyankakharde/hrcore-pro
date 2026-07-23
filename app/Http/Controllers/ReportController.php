<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display Reports Dashboard
     */
    public function index(Request $request)
    {
        $query = Report::with(['employee', 'creator']);

        // Search
        if ($request->filled('search')) {

            $query->where('report_name', 'like', '%' . $request->search . '%');

        }

        // Report Type Filter
        if ($request->filled('report_type')) {

            $query->where('report_type', $request->report_type);

        }

        // From Date
        if ($request->filled('from_date')) {

            $query->whereDate('from_date', '>=', $request->from_date);

        }

        // To Date
        if ($request->filled('to_date')) {

            $query->whereDate('to_date', '<=', $request->to_date);

        }

        $reports = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalReports = Report::count();

        $attendanceReports = Report::where(
            'report_type',
            'Attendance'
        )->count();

        $leaveReports = Report::where(
            'report_type',
            'Leave'
        )->count();

        $payrollReports = Report::where(
            'report_type',
            'Payroll'
        )->count();

        $employeeReports = Report::where(
            'report_type',
            'Employee'
        )->count();

        return view(
            'reports.index',
            compact(
                'reports',
                'totalReports',
                'attendanceReports',
                'leaveReports',
                'payrollReports',
                'employeeReports'
            )
        );
    }

    /**
     * Show Create Report Form
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();

        $reportTypes = [
            'Attendance',
            'Leave',
            'Payroll',
            'Performance',
            'Employee'
        ];

        return view(
            'reports.create',
            compact(
                'employees',
                'reportTypes'
            )
        );
    }
        /**
     * Store Report
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_name' => 'nullable|string|max:255',
            'employee_id' => 'nullable|exists:employees,id',
            'report_type' => 'required|in:Attendance,Leave,Payroll,Performance,Employee',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'description' => 'nullable|string|max:1000',
        ]);

        $reportName = $request->report_name;

        if (empty($reportName)) {
            $reportName = $request->report_type .
                ' Report (' .
                date('d M Y', strtotime($request->from_date)) .
                ' - ' .
                date('d M Y', strtotime($request->to_date)) .
                ')';
        }

        Report::create([
            'employee_id' => $request->employee_id,
            'report_name' => $reportName,
            'report_type' => $request->report_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'description' => $request->description,
            'filters' => [
                'generated_at' => now()->toDateTimeString(),
                'generated_by' => auth()->id(),
            ],
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report created successfully.');
    }

    /**
     * Show Report
     */
    public function show(Report $report)
    {
        $report->load(['employee', 'creator']);

        return view('reports.show', compact('report'));
    }

    /**
     * Edit Report
     */
    public function edit(Report $report)
    {
        $employees = Employee::orderBy('name')->get();

        $reportTypes = [
            'Attendance',
            'Leave',
            'Payroll',
            'Performance',
            'Employee'
        ];

        return view(
            'reports.edit',
            compact(
                'report',
                'employees',
                'reportTypes'
            )
        );
    }
        /**
     * Update Report
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'report_name' => 'required|string|max:255',
            'employee_id' => 'nullable|exists:employees,id',
            'report_type' => 'required|in:Attendance,Leave,Payroll,Performance,Employee',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'description' => 'nullable|string|max:1000',
        ]);

        $report->update([
            'report_name' => $request->report_name,
            'employee_id' => $request->employee_id,
            'report_type' => $request->report_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'description' => $request->description,
            'filters' => array_merge($report->filters ?? [], [
                'updated_at' => now()->toDateTimeString(),
                'updated_by' => auth()->id(),
            ]),
        ]);

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report updated successfully.');
    }

    /**
     * Delete Report
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    /**
     * Download Report
     */
    public function download(Report $report)
    {
        if (!$report->file_path || !file_exists(storage_path('app/' . $report->file_path))) {
            return back()->with('error', 'Report file not found.');
        }

        return response()->download(
            storage_path('app/' . $report->file_path)
        );
    }

    /**
     * Export Report
     */
    public function export(Request $request)
    {
        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Export functionality will be implemented in the next phase.'
            );
    }
}