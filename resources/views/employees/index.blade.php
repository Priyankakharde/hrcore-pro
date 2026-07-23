@extends('layouts.app')

@section('content')

<div class="p-8 bg-[#f5f7fb] min-h-screen">

    <!-- TOP HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

        <div>
            <h1 class="text-4xl font-bold text-gray-800">
                Employee Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage all employees from one dashboard
            </p>
        </div>

        <div class="flex gap-4">

            <!-- SEARCH -->
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search employee..."
                    class="pl-12 pr-4 py-3 rounded-2xl border border-gray-200 bg-white w-[260px] focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <span class="absolute left-4 top-3.5 text-gray-400">
                    🔍
                </span>
            </div>

            <!-- ADD BUTTON -->
            <a href="{{ route('employees.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg transition">

                + Add Employee
            </a>

        </div>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">

        <!-- TABLE HEADER -->
        <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Employee List
                </h2>

                <p class="text-gray-400 text-sm mt-1">
                    Total Employees: {{ $employees->count() }}
                </p>
            </div>

            <button class="bg-gray-100 px-4 py-2 rounded-xl text-sm text-gray-600">
                Last month
            </button>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr class="text-left text-gray-500 text-sm uppercase">

                        <th class="px-8 py-5">Employee</th>
                        <th class="px-6 py-5">Department</th>
                        <th class="px-6 py-5">Designation</th>
                        <th class="px-6 py-5">Salary</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5">Joining Date</th>
                        <th class="px-6 py-5 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employees as $employee)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- EMPLOYEE -->
                        <td class="px-8 py-5">

                            <div class="flex items-center gap-4">

                                <!-- AVATAR -->
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-800">
                                        {{ $employee->name }}
                                    </h3>

                                    <p class="text-sm text-gray-400">
                                        {{ $employee->email }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- DEPARTMENT -->
                        <td class="px-6 py-5">

                            <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">
                                {{ $employee->department }}
                            </span>

                        </td>

                        <!-- DESIGNATION -->
                        <td class="px-6 py-5 text-gray-700 font-medium">
                            {{ $employee->designation }}
                        </td>

                        <!-- SALARY -->
                        <td class="px-6 py-5 font-bold text-gray-800">
                            ₹{{ number_format($employee->salary) }}
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            @if($employee->status == 'Active')

                                <span class="px-4 py-2 rounded-full bg-green-100 text-green-600 text-sm font-semibold">
                                    Active
                                </span>

                            @else

                                <span class="px-4 py-2 rounded-full bg-red-100 text-red-600 text-sm font-semibold">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-5 text-gray-500">
                            {{ $employee->joining_date }}
                        </td>

                        <!-- ACTIONS -->
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <!-- EDIT -->
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                   class="px-4 py-2 rounded-xl bg-purple-100 text-purple-600 hover:bg-purple-200 transition">

                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete Employee?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-4 py-2 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition">

                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <!-- EMPTY STATE -->
                    <tr>

                        <td colspan="7" class="text-center py-20">

                            <div class="flex flex-col items-center">

                                <div class="text-6xl mb-5">
                                    👨‍💼
                                </div>

                                <h2 class="text-2xl font-bold text-gray-700 mb-2">
                                    No Employees Found
                                </h2>

                                <p class="text-gray-400 mb-6">
                                    Start by adding your first employee
                                </p>

                                <a href="{{ route('employees.create') }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold">

                                    + Add Employee
                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection