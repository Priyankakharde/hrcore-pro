<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Payroll Dashboard
     */
    public function index(Request $request)
    {
        $query = Salary::with('employee');

        // Search Employee
        if ($request->search) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('employee_id', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Month
        if ($request->month) {
            $query->where('month', $request->month);
        }

        // Filter Status
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $salaries = $query->latest()->paginate(10);

        // Dashboard Stats
        $totalPayroll = Salary::sum('net_salary');

        $paidPayroll = Salary::where(
            'payment_status',
            'Paid'
        )->sum('net_salary');

        $pendingPayroll = Salary::where(
            'payment_status',
            'Pending'
        )->sum('net_salary');

        $employeeCount = Employee::count();

        return view('payments.index', compact(
            'salaries',
            'totalPayroll',
            'paidPayroll',
            'pendingPayroll',
            'employeeCount'
        ));
    }

    /**
     * Create Salary Form
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();

        return view('payments.create', compact('employees'));
    }

    /**
     * Store Salary
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id'      => 'required|exists:employees,id',
            'basic_salary'     => 'required|numeric|min:0',
            'bonus'            => 'nullable|numeric|min:0',
            'overtime_amount'  => 'nullable|numeric|min:0',
            'tax'              => 'nullable|numeric|min:0',
            'deduction'        => 'nullable|numeric|min:0',
            'month'            => 'required',
            'payment_method'   => 'nullable|string',
            'payment_status'   => 'required',
            'payment_date'     => 'nullable|date',
            'notes'            => 'nullable|string',
        ]);

        $basic = $request->basic_salary;
        $bonus = $request->bonus ?? 0;
        $overtime = $request->overtime_amount ?? 0;
        $tax = $request->tax ?? 0;
        $deduction = $request->deduction ?? 0;

        $netSalary =
            $basic +
            $bonus +
            $overtime -
            $tax -
            $deduction;

        Salary::create([
            'employee_id'      => $request->employee_id,
            'basic_salary'     => $basic,
            'bonus'            => $bonus,
            'overtime_amount'  => $overtime,
            'tax'              => $tax,
            'deduction'        => $deduction,
            'net_salary'       => $netSalary,
            'month'            => $request->month,
            'payment_method'   => $request->payment_method,
            'payment_status'   => $request->payment_status,
            'payment_date'     => $request->payment_date,
            'notes'            => $request->notes,
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payroll created successfully.');
    }

    /**
     * Show Salary
     */
    public function show(Salary $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Edit Salary
     */
    public function edit(Salary $payment)
    {
        $employees = Employee::orderBy('name')->get();

        return view('payments.edit', compact(
            'payment',
            'employees'
        ));
    }

    /**
     * Update Salary
     */
    public function update(Request $request, Salary $payment)
    {
        $request->validate([
            'employee_id'      => 'required|exists:employees,id',
            'basic_salary'     => 'required|numeric|min:0',
            'bonus'            => 'nullable|numeric|min:0',
            'overtime_amount'  => 'nullable|numeric|min:0',
            'tax'              => 'nullable|numeric|min:0',
            'deduction'        => 'nullable|numeric|min:0',
            'month'            => 'required',
            'payment_method'   => 'nullable|string',
            'payment_status'   => 'required',
            'payment_date'     => 'nullable|date',
            'notes'            => 'nullable|string',
        ]);

        $basic = $request->basic_salary;
        $bonus = $request->bonus ?? 0;
        $overtime = $request->overtime_amount ?? 0;
        $tax = $request->tax ?? 0;
        $deduction = $request->deduction ?? 0;

        $netSalary =
            $basic +
            $bonus +
            $overtime -
            $tax -
            $deduction;

        $payment->update([
            'employee_id'      => $request->employee_id,
            'basic_salary'     => $basic,
            'bonus'            => $bonus,
            'overtime_amount'  => $overtime,
            'tax'              => $tax,
            'deduction'        => $deduction,
            'net_salary'       => $netSalary,
            'month'            => $request->month,
            'payment_method'   => $request->payment_method,
            'payment_status'   => $request->payment_status,
            'payment_date'     => $request->payment_date,
            'notes'            => $request->notes,
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payroll updated successfully.');
    }

    /**
     * Delete Salary
     */
    public function destroy(Salary $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payroll deleted successfully.');
    }
}
