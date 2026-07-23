<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // SHOW EMPLOYEES
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employees.index', compact('employees'));
    }

    // CREATE PAGE
    public function create()
    {
        return view('employees.create');
    }

    // STORE EMPLOYEE
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
        ]);

        Employee::create($request->all());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee Added Successfully');
    }

    // EDIT PAGE
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // UPDATE EMPLOYEE
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'employee_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
        ]);

        $employee->update($request->all());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee Updated Successfully');
    }

    // DELETE EMPLOYEE
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee Deleted Successfully');
    }
}