@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="space-y-8">

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-xl overflow-hidden">

        <div class="px-8 py-10 flex flex-col lg:flex-row justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold text-white">
                    Reports Dashboard
                </h1>

                <p class="mt-3 text-indigo-100 text-lg">
                    Generate, manage and download HR reports with advanced analytics.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">

                    <a href="{{ route('reports.create') }}"
                       class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold shadow hover:bg-gray-100 transition">

                        ➕ Generate Report

                    </a>

                    <a href="{{ route('reports.export') }}"
                       class="bg-indigo-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-indigo-400 transition">

                        📤 Export Reports

                    </a>

                </div>

            </div>

            <div class="hidden lg:block text-8xl text-white opacity-20">
                📊
            </div>

        </div>

    </div>

    <!-- Statistics Cards -->

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

        <!-- Total Reports -->

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-indigo-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Total Reports
                    </p>

                    <h2 class="text-3xl font-bold mt-2">

                        {{ $totalReports }}

                    </h2>

                </div>

                <div class="text-4xl">
                    📁
                </div>

            </div>

        </div>

        <!-- Attendance -->

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Attendance
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">

                        {{ $attendanceReports }}

                    </h2>

                </div>

                <div class="text-4xl">
                    ✅
                </div>

            </div>

        </div>

        <!-- Leave -->

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Leave
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mt-2">

                        {{ $leaveReports }}

                    </h2>

                </div>

                <div class="text-4xl">
                    🏖️
                </div>

            </div>

        </div>

        <!-- Payroll -->

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Payroll
                    </p>

                    <h2 class="text-3xl font-bold text-blue-600 mt-2">

                        {{ $payrollReports }}

                    </h2>

                </div>

                <div class="text-4xl">
                    💰
                </div>

            </div>

        </div>

        <!-- Employee -->

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Employee
                    </p>

                    <h2 class="text-3xl font-bold text-purple-600 mt-2">

                        {{ $employeeReports }}

                    </h2>

                </div>

                <div class="text-4xl">
                    👥
                </div>

            </div>

        </div>

    </div>
        <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <form method="GET" action="{{ route('reports.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">

                <!-- Search -->
                <div class="lg:col-span-2">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Search Report
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Report Name..."
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500">

                </div>

                <!-- Report Type -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Report Type
                    </label>

                    <select
                        name="report_type"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500">

                        <option value="">All Types</option>

                        <option value="Attendance"
                            {{ request('report_type') == 'Attendance' ? 'selected' : '' }}>
                            Attendance
                        </option>

                        <option value="Leave"
                            {{ request('report_type') == 'Leave' ? 'selected' : '' }}>
                            Leave
                        </option>

                        <option value="Payroll"
                            {{ request('report_type') == 'Payroll' ? 'selected' : '' }}>
                            Payroll
                        </option>

                        <option value="Performance"
                            {{ request('report_type') == 'Performance' ? 'selected' : '' }}>
                            Performance
                        </option>

                        <option value="Employee"
                            {{ request('report_type') == 'Employee' ? 'selected' : '' }}>
                            Employee
                        </option>

                    </select>

                </div>

                <!-- From Date -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        From Date
                    </label>

                    <input
                        type="date"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500">

                </div>

                <!-- To Date -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        To Date
                    </label>

                    <input
                        type="date"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500">

                </div>

                <!-- Search Button -->
                <div class="flex items-end">

                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">

                        🔍 Search

                    </button>

                </div>

            </div>

            <div class="mt-5 flex justify-end gap-3">

                <a href="{{ route('reports.index') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl font-semibold transition">

                    Reset

                </a>

                <a href="{{ route('reports.create') }}"
                   class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold transition">

                    + Generate Report

                </a>

            </div>

        </form>

    </div>

    <!-- Reports Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 py-5 border-b">

            <h2 class="text-2xl font-bold text-gray-800">
                Reports List
            </h2>

            <p class="text-gray-500 mt-1">
                View, manage and download generated HR reports.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Report Name</th>

                        <th class="px-6 py-4 text-left">Type</th>

                        <th class="px-6 py-4 text-left">Employee</th>

                        <th class="px-6 py-4 text-left">Period</th>

                        <th class="px-6 py-4 text-left">Created By</th>

                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">
                                    @forelse($reports as $report)

                    <tr class="hover:bg-gray-50 transition">

                        <!-- Report Name -->
                        <td class="px-6 py-4">

                            <div>

                                <h3 class="font-semibold text-gray-800">
                                    {{ $report->report_name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    ID #{{ $report->id }}
                                </p>

                            </div>

                        </td>

                        <!-- Report Type -->
                        <td class="px-6 py-4">

                            @switch($report->report_type)

                                @case('Attendance')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        Attendance
                                    </span>
                                    @break

                                @case('Leave')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                        Leave
                                    </span>
                                    @break

                                @case('Payroll')
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                                        Payroll
                                    </span>
                                    @break

                                @case('Performance')
                                    <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold">
                                        Performance
                                    </span>
                                    @break

                                @default
                                    <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                                        Employee
                                    </span>

                            @endswitch

                        </td>

                        <!-- Employee -->
                        <td class="px-6 py-4">

                            @if($report->employee)

                                <div>

                                    <p class="font-semibold text-gray-800">
                                        {{ $report->employee->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $report->employee->employee_id }}
                                    </p>

                                </div>

                            @else

                                <span class="text-gray-400">
                                    All Employees
                                </span>

                            @endif

                        </td>

                        <!-- Report Period -->
                        <td class="px-6 py-4">

                            <div>

                                <p class="font-medium">
                                    {{ $report->from_date->format('d M Y') }}
                                </p>

                                <p class="text-gray-500 text-sm">
                                    to
                                    {{ $report->to_date->format('d M Y') }}
                                </p>

                            </div>

                        </td>

                        <!-- Created By -->
                        <td class="px-6 py-4">

                            {{ $report->creator->name ?? 'System' }}

                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <!-- View -->
                                <a href="{{ route('reports.show', $report) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

                                    View

                                </a>

                                <!-- Edit -->
                                <a href="{{ route('reports.edit', $report) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                                    Edit

                                </a>

                                <!-- Download -->
                                <a href="{{ route('reports.download', $report) }}"
                                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg">

                                    Download

                                </a>

                                <!-- Delete -->
                                <form action="{{ route('reports.destroy', $report) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this report?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="px-6 py-12 text-center">

                            <div class="text-6xl mb-4">
                                📊
                            </div>

                            <h3 class="text-2xl font-bold text-gray-700">

                                No Reports Found

                            </h3>

                            <p class="text-gray-500 mt-2">

                                Generate your first HR report to get started.

                            </p>

                        </td>

                    </tr>

                @endforelse
                                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        @if($reports->hasPages())

            <div class="px-6 py-4 border-t bg-gray-50">

                {{ $reports->links() }}

            </div>

        @endif

    </div>

    <!-- Success Message -->
    @if(session('success'))

        <div class="fixed top-5 right-5 z-50">

            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl shadow-lg">

                <div class="flex items-center">

                    <span class="text-2xl mr-3">
                        ✅
                    </span>

                    <div>

                        <h4 class="font-bold">
                            Success
                        </h4>

                        <p>
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    @endif

    <!-- Error Message -->
    @if(session('error'))

        <div class="fixed top-5 right-5 z-50">

            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-lg">

                <div class="flex items-center">

                    <span class="text-2xl mr-3">
                        ❌
                    </span>

                    <div>

                        <h4 class="font-bold">
                            Error
                        </h4>

                        <p>
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection

@push('scripts')

<script>

    // Auto Hide Notifications
    setTimeout(function () {

        document.querySelectorAll('.fixed.top-5').forEach(function (alert) {

            alert.style.transition = 'opacity .5s';

            alert.style.opacity = '0';

            setTimeout(function () {

                alert.remove();

            }, 500);

        });

    }, 3000);

</script>

@endpush