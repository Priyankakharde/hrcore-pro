@extends('layouts.app')

@section('title', 'Mark Attendance')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-xl p-8 text-white mb-8">

        <h1 class="text-4xl font-bold">
            Mark Employee Attendance
        </h1>

        <p class="mt-3 text-blue-100">
            Record employee attendance, working hours, shift details and notes.
        </p>

    </div>

    <!-- Validation Errors -->
    @if ($errors->any())

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-5 rounded-xl mb-6">

            <h4 class="font-bold mb-2">
                Please fix the following errors:
            </h4>

            <ul class="list-disc ml-6">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Attendance Form -->
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('attendance.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Employee -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Employee
                    </label>

                    <select
                        name="employee_id"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                        <option value="">
                            Select Employee
                        </option>

                        @foreach($employees as $employee)

                            <option
                                value="{{ $employee->id }}"
                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>

                                {{ $employee->name }} ({{ $employee->employee_id }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Attendance Date -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Attendance Date
                    </label>

                    <input
                        type="date"
                        name="attendance_date"
                        value="{{ old('attendance_date', date('Y-m-d')) }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                </div>

                <!-- Check In -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Check In
                    </label>

                    <input
                        type="time"
                        name="check_in"
                        value="{{ old('check_in') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                </div>

                <!-- Check Out -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Check Out
                    </label>

                    <input
                        type="time"
                        name="check_out"
                        value="{{ old('check_out') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                </div>
                                <!-- Shift -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Shift
                    </label>

                    <select
                        name="shift"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                        <option value="">Select Shift</option>

                        <option value="Morning" {{ old('shift') == 'Morning' ? 'selected' : '' }}>
                            Morning
                        </option>

                        <option value="Afternoon" {{ old('shift') == 'Afternoon' ? 'selected' : '' }}>
                            Afternoon
                        </option>

                        <option value="Evening" {{ old('shift') == 'Evening' ? 'selected' : '' }}>
                            Evening
                        </option>

                        <option value="Night" {{ old('shift') == 'Night' ? 'selected' : '' }}>
                            Night
                        </option>

                    </select>

                </div>

                <!-- Status -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                        <option value="">Select Status</option>

                        <option value="Present" {{ old('status') == 'Present' ? 'selected' : '' }}>
                            Present
                        </option>

                        <option value="Absent" {{ old('status') == 'Absent' ? 'selected' : '' }}>
                            Absent
                        </option>

                        <option value="Leave" {{ old('status') == 'Leave' ? 'selected' : '' }}>
                            Leave
                        </option>

                        <option value="Half Day" {{ old('status') == 'Half Day' ? 'selected' : '' }}>
                            Half Day
                        </option>

                        <option value="Holiday" {{ old('status') == 'Holiday' ? 'selected' : '' }}>
                            Holiday
                        </option>

                    </select>

                </div>

                <!-- Location -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Location
                    </label>

                    <input
                        type="text"
                        name="location"
                        value="{{ old('location') }}"
                        placeholder="Office / Remote / Client Site"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                </div>

                <!-- Notes -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="4"
                        placeholder="Enter any additional notes..."
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>

                </div>

            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 mt-8">

                <a href="{{ route('attendance.index') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl font-semibold transition">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow transition">

                    Save Attendance

                </button>

            </div>

        </form>

    </div>

</div>

@endsection