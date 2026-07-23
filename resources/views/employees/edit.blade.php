@extends('layouts.app')

@section('content')

<div class="p-8 bg-[#f5f7fb] min-h-screen">

    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-sm p-10">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-10">

            <div>
                <h1 class="text-5xl font-bold text-gray-800">
                    Edit Employee
                </h1>

                <p class="text-gray-400 mt-2">
                    Update employee information
                </p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="px-6 py-3 rounded-2xl bg-gray-100 hover:bg-gray-200 transition text-gray-700">

                Back
            </a>

        </div>

        <!-- FORM -->
        <form action="{{ route('employees.update', $employee->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- EMPLOYEE ID -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Employee ID
                    </label>

                    <input type="text"
                           name="employee_id"
                           value="{{ $employee->employee_id }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- NAME -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $employee->name }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ $employee->email }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- PHONE -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Phone
                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ $employee->phone }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- DEPARTMENT -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Department
                    </label>

                    <select name="department"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option {{ $employee->department == 'Development' ? 'selected' : '' }}>
                            Development
                        </option>

                        <option {{ $employee->department == 'HR' ? 'selected' : '' }}>
                            HR
                        </option>

                        <option {{ $employee->department == 'Finance' ? 'selected' : '' }}>
                            Finance
                        </option>

                        <option {{ $employee->department == 'Support' ? 'selected' : '' }}>
                            Support
                        </option>

                        <option {{ $employee->department == 'Operations' ? 'selected' : '' }}>
                            Operations
                        </option>

                    </select>
                </div>

                <!-- DESIGNATION -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Designation
                    </label>

                    <input type="text"
                           name="designation"
                           value="{{ $employee->designation }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- SALARY -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Salary
                    </label>

                    <input type="number"
                           name="salary"
                           value="{{ $employee->salary }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- JOINING DATE -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Joining Date
                    </label>

                    <input type="date"
                           name="joining_date"
                           value="{{ $employee->joining_date }}"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- STATUS -->
                <div>
                    <label class="block text-gray-700 mb-3 font-medium">
                        Status
                    </label>

                    <select name="status"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option value="Active"
                            {{ $employee->status == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="Inactive"
                            {{ $employee->status == 'Inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                    Update Employee
                </button>

            </div>

        </form>

    </div>

</div>

@endsection