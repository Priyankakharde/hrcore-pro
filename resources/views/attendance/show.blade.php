@extends('layouts.app')

@section('title', 'Attendance Details')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600 rounded-3xl shadow-xl p-8 text-white mb-8">

        <div class="flex flex-col md:flex-row justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold">
                    Attendance Details
                </h1>

                <p class="mt-3 text-blue-100">
                    View complete attendance information for this employee.
                </p>

            </div>

            <div class="mt-6 md:mt-0">

                <a href="{{ route('attendance.edit', $attendance) }}"
                   class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold shadow hover:bg-gray-100 transition">

                    ✏️ Edit Attendance

                </a>

            </div>

        </div>

    </div>

    <!-- Employee Information -->
    <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

        <div class="flex items-center">

            <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-700">

                {{ strtoupper(substr($attendance->employee->name ?? 'N', 0, 1)) }}

            </div>

            <div class="ml-6">

                <h2 class="text-2xl font-bold text-gray-800">

                    {{ $attendance->employee->name }}

                </h2>

                <p class="text-gray-500 mt-1">

                    Employee ID:
                    <span class="font-semibold">

                        {{ $attendance->employee->employee_id }}

                    </span>

                </p>

            </div>

        </div>

    </div>

    <!-- Attendance Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Attendance Date -->
        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500 text-sm uppercase">

                Attendance Date

            </p>

            <h3 class="text-2xl font-bold mt-2">

                {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}

            </h3>

        </div>

        <!-- Check In -->
        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500 text-sm uppercase">

                Check In

            </p>

            <h3 class="text-2xl font-bold mt-2 text-green-600">

                {{ $attendance->check_in ?? '-' }}

            </h3>

        </div>

        <!-- Check Out -->
        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500 text-sm uppercase">

                Check Out

            </p>

            <h3 class="text-2xl font-bold mt-2 text-red-600">

                {{ $attendance->check_out ?? '-' }}

            </h3>

        </div>

        <!-- Working Hours -->
        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500 text-sm uppercase">

                Working Hours

            </p>

            <h3 class="text-2xl font-bold mt-2 text-blue-600">

                {{ $attendance->working_hours }} hrs

            </h3>

        </div>

    </div>
        <!-- Additional Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">

        <!-- Attendance Information -->
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Attendance Information
            </h2>

            <div class="space-y-5">

                <!-- Status -->
                <div class="flex justify-between items-center">

                    <span class="text-gray-600 font-medium">
                        Status
                    </span>

                    @switch($attendance->status)

                        @case('Present')

                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">
                                ✅ Present
                            </span>

                            @break

                        @case('Absent')

                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">
                                ❌ Absent
                            </span>

                            @break

                        @case('Leave')

                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                🏖 Leave
                            </span>

                            @break

                        @case('Half Day')

                            <span class="px-4 py-2 rounded-full bg-orange-100 text-orange-700 font-semibold">
                                🌤 Half Day
                            </span>

                            @break

                        @default

                            <span class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 font-semibold">
                                {{ $attendance->status }}
                            </span>

                    @endswitch

                </div>

                <!-- Shift -->
                <div class="flex justify-between">

                    <span class="text-gray-600 font-medium">
                        Shift
                    </span>

                    <span class="font-semibold">
                        {{ $attendance->shift }}
                    </span>

                </div>

                <!-- Working Hours -->
                <div class="flex justify-between">

                    <span class="text-gray-600 font-medium">
                        Working Hours
                    </span>

                    <span class="font-semibold text-blue-600">
                        {{ $attendance->working_hours }} hrs
                    </span>

                </div>

                <!-- Overtime -->
                <div class="flex justify-between">

                    <span class="text-gray-600 font-medium">
                        Overtime
                    </span>

                    <span class="font-semibold text-purple-600">
                        {{ $attendance->overtime_hours }} hrs
                    </span>

                </div>

                <!-- Break Hours -->
                <div class="flex justify-between">

                    <span class="text-gray-600 font-medium">
                        Break Hours
                    </span>

                    <span class="font-semibold">
                        {{ $attendance->break_hours }} hrs
                    </span>

                </div>

            </div>

        </div>

        <!-- Additional Information -->
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Additional Information
            </h2>

            <div class="space-y-5">

                <div>

                    <label class="text-gray-500 text-sm font-semibold">
                        Location
                    </label>

                    <p class="mt-1 text-gray-800">
                        {{ $attendance->location ?: 'N/A' }}
                    </p>

                </div>

                <div>

                    <label class="text-gray-500 text-sm font-semibold">
                        IP Address
                    </label>

                    <p class="mt-1 text-gray-800">
                        {{ $attendance->ip_address ?: 'N/A' }}
                    </p>

                </div>

                <div>

                    <label class="text-gray-500 text-sm font-semibold">
                        Device
                    </label>

                    <p class="mt-1 text-gray-800 break-all">
                        {{ $attendance->device ?: 'N/A' }}
                    </p>

                </div>

                <div>

                    <label class="text-gray-500 text-sm font-semibold">
                        Notes
                    </label>

                    <div class="mt-2 bg-gray-50 rounded-xl p-4">

                        {{ $attendance->notes ?: 'No notes available.' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between items-center mt-8">

        <a href="{{ route('attendance.index') }}"
           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl font-semibold transition">

            ← Back to Attendance

        </a>

        <a href="{{ route('attendance.edit', $attendance) }}"
           class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow transition">

            ✏️ Edit Attendance

        </a>

    </div>

</div>

@endsection