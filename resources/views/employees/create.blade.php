@extends('layouts.app')

@section('content')

<div class="p-8 bg-[#f5f6fa] min-h-screen">

    <div class="max-w-4xl mx-auto bg-white rounded-3xl p-8 shadow-sm">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    Add Employee
                </h1>

                <p class="text-gray-400 mt-2">
                    Create new employee profile
                </p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="px-5 py-3 bg-gray-100 rounded-2xl hover:bg-gray-200 transition">

                Back

            </a>

        </div>

        <form action="{{ route('employees.store') }}"
              method="POST"
              class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @csrf

            <!-- Employee ID -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Employee ID
                </label>

                <input type="text"
                       name="employee_id"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="EMP001">
            </div>

            <!-- Name -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Full Name
                </label>

                <input type="text"
                       name="name"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="John Doe">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="john@example.com">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="+91 9876543210">
            </div>

            <!-- Department -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Department
                </label>

                <select name="department"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option>Development</option>
                    <option>Design</option>
                    <option>Finance</option>
                    <option>HR</option>
                    <option>Support</option>

                </select>
            </div>

            <!-- Designation -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Designation
                </label>

                <input type="text"
                       name="designation"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Laravel Developer">
            </div>

            <!-- Salary -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Salary
                </label>

                <input type="number"
                       name="salary"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="50000">
            </div>

            <!-- Joining Date -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Joining Date
                </label>

                <input type="date"
                       name="joining_date"
                       class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Status -->
            <div>
                <label class="block text-gray-600 mb-2">
                    Status
                </label>

                <select name="status"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option>Active</option>
                    <option>Inactive</option>

                </select>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 pt-4">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl shadow-md transition">

                    Save Employee

                </button>

            </div>

        </form>

    </div>

</div>

@endsection