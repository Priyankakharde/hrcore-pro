@extends('layouts.app')

@section('title', 'Attendance Management')

@section('content')

<div class="space-y-8">

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl shadow-xl overflow-hidden">
        <div class="px-8 py-10 flex flex-col lg:flex-row justify-between items-center">

            <div class="text-white">

                <h1 class="text-4xl font-bold">
                    Attendance Management
                </h1>

                <p class="mt-3 text-blue-100 text-lg">
                    Track employee attendance, working hours, overtime, and daily records.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">

                    <a href="{{ route('attendance.create') }}"
                       class="px-6 py-3 bg-white text-blue-600 rounded-xl font-semibold shadow hover:bg-blue-50 transition">
                        ➕ Mark Attendance
                    </a>

                    <a href="{{ route('reports.index') }}"
                       class="px-6 py-3 bg-blue-500 text-white rounded-xl font-semibold shadow hover:bg-blue-400 transition">
                        📊 Attendance Reports
                    </a>

                </div>

            </div>

            <div class="hidden lg:block">
                <div class="text-8xl text-white opacity-20">
                    📅
                </div>
            </div>

        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

        <!-- Total Employees -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Total Employees
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        {{ $totalEmployees }}
                    </h2>

                </div>

                <div class="text-4xl">
                    👥
                </div>

            </div>

        </div>

        <!-- Present -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Present Today
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $presentToday }}
                    </h2>

                </div>

                <div class="text-4xl">
                    ✅
                </div>

            </div>

        </div>

        <!-- Absent -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Absent
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $absentToday }}
                    </h2>

                </div>

                <div class="text-4xl">
                    ❌
                </div>

            </div>

        </div>

        <!-- Leave -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        On Leave
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $leaveToday }}
                    </h2>

                </div>

                <div class="text-4xl">
                    🏖️
                </div>

            </div>

        </div>

        <!-- Attendance Rate -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm uppercase">
                        Attendance %
                    </p>

                    <h2 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $attendanceRate }}%
                    </h2>

                </div>

                <div class="text-4xl">
                    📈
                </div>

            </div>

        </div>

    </div>
        <!-- Filters Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <form method="GET" action="{{ route('attendance.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">

                <!-- Search -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Search Employee
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Employee Name or Employee ID"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                        <option value="">All Status</option>

                        <option value="Present"
                            {{ request('status')=='Present' ? 'selected' : '' }}>
                            Present
                        </option>

                        <option value="Absent"
                            {{ request('status')=='Absent' ? 'selected' : '' }}>
                            Absent
                        </option>

                        <option value="Leave"
                            {{ request('status')=='Leave' ? 'selected' : '' }}>
                            Leave
                        </option>

                        <option value="Half Day"
                            {{ request('status')=='Half Day' ? 'selected' : '' }}>
                            Half Day
                        </option>

                        <option value="Holiday"
                            {{ request('status')=='Holiday' ? 'selected' : '' }}>
                            Holiday
                        </option>

                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end">

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">

                        🔍 Search

                    </button>

                </div>

                <!-- Reset -->
                <div class="flex items-end">

                    <a href="{{ route('attendance.index') }}"
                       class="w-full text-center bg-gray-200 hover:bg-gray-300 py-3 rounded-xl font-semibold transition">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="flex justify-between items-center p-6 border-b">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Attendance Records
                </h2>

                <p class="text-gray-500 mt-1">
                    Daily employee attendance information.
                </p>

            </div>

            <a href="{{ route('attendance.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-semibold">

                + Mark Attendance

            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Employee</th>

                        <th class="px-6 py-4 text-left">Date</th>

                        <th class="px-6 py-4 text-left">Check In</th>

                        <th class="px-6 py-4 text-left">Check Out</th>

                        <th class="px-6 py-4 text-left">Hours</th>

                        <th class="px-6 py-4 text-left">Overtime</th>

                        <th class="px-6 py-4 text-left">Status</th>

                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">
                                    @forelse($attendances as $attendance)

                    <tr class="hover:bg-gray-50 transition">

                        <!-- Employee -->
                        <td class="px-6 py-4">

                            <div class="flex items-center">

                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-lg font-bold text-blue-700">

                                    {{ strtoupper(substr($attendance->employee->name ?? 'N', 0, 1)) }}

                                </div>

                                <div class="ml-4">

                                    <h3 class="font-semibold text-gray-800">
                                        {{ $attendance->employee->name ?? 'N/A' }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        {{ $attendance->employee->employee_id ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                        </td>

                        <!-- Check In -->
                        <td class="px-6 py-4">
                            {{ $attendance->check_in ?? '-' }}
                        </td>

                        <!-- Check Out -->
                        <td class="px-6 py-4">
                            {{ $attendance->check_out ?? '-' }}
                        </td>

                        <!-- Working Hours -->
                        <td class="px-6 py-4">

                            <span class="font-semibold text-blue-600">

                                {{ $attendance->working_hours }}

                                hrs

                            </span>

                        </td>

                        <!-- Overtime -->
                        <td class="px-6 py-4">

                            @if($attendance->overtime_hours > 0)

                                <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold">

                                    +{{ $attendance->overtime_hours }} hrs

                                </span>

                            @else

                                -

                            @endif

                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">

                            @switch($attendance->status)

                                @case('Present')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        Present
                                    </span>

                                    @break

                                @case('Absent')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                        Absent
                                    </span>

                                    @break

                                @case('Leave')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                        Leave
                                    </span>

                                    @break

                                @case('Half Day')

                                    <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold">
                                        Half Day
                                    </span>

                                    @break

                                @default

                                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm font-semibold">
                                        {{ $attendance->status }}
                                    </span>

                            @endswitch

                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('attendance.show', $attendance) }}"
                                   class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">

                                    View

                                </a>

                                <a href="{{ route('attendance.edit', $attendance) }}"
                                   class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">

                                    Edit

                                </a>

                                <form action="{{ route('attendance.destroy', $attendance) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this attendance record?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="px-6 py-12 text-center">

                            <div class="text-6xl mb-4">
                                📅
                            </div>

                            <h3 class="text-xl font-semibold text-gray-700">
                                No Attendance Records Found
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Start by marking attendance for your employees.
                            </p>

                        </td>

                    </tr>

                @endforelse
                                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        @if($attendances->hasPages())

            <div class="px-6 py-4 border-t bg-gray-50">

                {{ $attendances->links() }}

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

    // Auto-hide alerts after 3 seconds
    setTimeout(function () {

        const alerts = document.querySelectorAll('.fixed.top-5');

        alerts.forEach(function(alert){

            alert.style.transition = "opacity .5s";

            alert.style.opacity = "0";

            setTimeout(function(){

                alert.remove();

            },500);

        });

    },3000);

</script>

@endpush