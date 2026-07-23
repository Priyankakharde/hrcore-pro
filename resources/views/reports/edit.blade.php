@extends('layouts.app')

@section('title', 'Edit Report')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-3xl shadow-xl p-8 text-white mb-8">

        <h1 class="text-4xl font-bold">
            Edit Report
        </h1>

        <p class="mt-3 text-yellow-100">
            Update report information, date range, employee, and report type.
        </p>

    </div>

    <!-- Validation Errors -->
    @if($errors->any())

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-5 rounded-xl mb-6">

            <h4 class="font-bold mb-2">
                Please fix the following errors:
            </h4>

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Edit Form -->
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('reports.update', $report) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Report Name -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Report Name
                    </label>

                    <input
                        type="text"
                        name="report_name"
                        value="{{ old('report_name', $report->report_name) }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500">

                </div>

                <!-- Employee -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Employee
                    </label>

                    <select
                        name="employee_id"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500">

                        <option value="">
                            All Employees
                        </option>

                        @foreach($employees as $employee)

                            <option
                                value="{{ $employee->id }}"
                                {{ old('employee_id', $report->employee_id) == $employee->id ? 'selected' : '' }}>

                                {{ $employee->name }}
                                ({{ $employee->employee_id }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Report Type -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Report Type
                    </label>

                    <select
                        name="report_type"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500">

                        @foreach($reportTypes as $type)

                            <option
                                value="{{ $type }}"
                                {{ old('report_type', $report->report_type) == $type ? 'selected' : '' }}>

                                {{ $type }}

                            </option>

                        @endforeach

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
                        value="{{ old('from_date', $report->from_date->format('Y-m-d')) }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500">

                </div>

                <!-- To Date -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        To Date
                    </label>

                    <input
                        type="date"
                        name="to_date"
                        value="{{ old('to_date', $report->to_date->format('Y-m-d')) }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500">

                </div>
                                <!-- Description -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500">{{ old('description', $report->description) }}</textarea>

                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 mt-8">

                <a href="{{ route('reports.index') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl font-semibold transition">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-semibold shadow transition">

                    ✏️ Update Report

                </button>

            </div>

        </form>

    </div>

</div>

@endsection