@extends('layouts.app')

@section('title', 'Report Details')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-xl p-8 text-white mb-8">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold">
                    Report Details
                </h1>

                <p class="mt-3 text-blue-100">
                    View complete information about this report.
                </p>

            </div>

            <div class="hidden md:block text-7xl opacity-20">

                📊

            </div>

        </div>

    </div>

    <!-- Report Details Card -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="px-8 py-6 border-b bg-gray-50">

            <h2 class="text-2xl font-bold text-gray-800">

                {{ $report->report_name }}

            </h2>

            <p class="text-gray-500">

                Report ID #{{ $report->id }}

            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

            <!-- Report Type -->
            <div>

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    Report Type

                </label>

                @switch($report->report_type)

                    @case('Attendance')

                        <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                            Attendance

                        </span>

                        @break

                    @case('Leave')

                        <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                            Leave

                        </span>

                        @break

                    @case('Payroll')

                        <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                            Payroll

                        </span>

                        @break

                    @case('Performance')

                        <span class="px-4 py-2 rounded-full bg-purple-100 text-purple-700 font-semibold">

                            Performance

                        </span>

                        @break

                    @default

                        <span class="px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">

                            Employee

                        </span>

                @endswitch

            </div>

            <!-- Employee -->
            <div>

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    Employee

                </label>

                @if($report->employee)

                    <div>

                        <p class="font-semibold text-gray-800">

                            {{ $report->employee->name }}

                        </p>

                        <p class="text-gray-500">

                            {{ $report->employee->employee_id }}

                        </p>

                    </div>

                @else

                    <span class="text-gray-500">

                        All Employees

                    </span>

                @endif

            </div>

            <!-- From Date -->
            <div>

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    From Date

                </label>

                <p class="text-gray-800 font-medium">

                    {{ $report->from_date->format('d M Y') }}

                </p>

            </div>

            <!-- To Date -->
            <div>

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    To Date

                </label>

                <p class="text-gray-800 font-medium">

                    {{ $report->to_date->format('d M Y') }}

                </p>

            </div>
                        <!-- Description -->
            <div class="md:col-span-2">

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    Description

                </label>

                <div class="bg-gray-50 rounded-xl p-4 border">

                    <p class="text-gray-700">

                        {{ $report->description ?: 'No description available.' }}

                    </p>

                </div>

            </div>

            <!-- Created By -->
            <div>

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    Created By

                </label>

                <p class="font-medium text-gray-800">

                    {{ $report->creator->name ?? 'System' }}

                </p>

            </div>

            <!-- Created At -->
            <div>

                <label class="block text-sm font-semibold text-gray-500 mb-2">

                    Created On

                </label>

                <p class="font-medium text-gray-800">

                    {{ $report->created_at->format('d M Y, h:i A') }}

                </p>

            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-end gap-4 px-8 py-6 border-t bg-gray-50">

            <a href="{{ route('reports.index') }}"
               class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition">

                ← Back

            </a>

            <a href="{{ route('reports.edit', $report) }}"
               class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-semibold transition">

                ✏️ Edit

            </a>

            @if($report->file_path)

                <a href="{{ route('reports.download', $report) }}"
                   class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold transition">

                    📥 Download

                </a>

            @endif

        </div>

    </div>

</div>

@endsection