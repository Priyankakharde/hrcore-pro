@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- ========================================================= -->
    <!-- PAGE HEADER -->
    <!-- ========================================================= -->

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-4xl font-bold text-gray-900">
                Good Morning, {{ Auth::user()->name }} 👋
            </h1>

            <p class="text-gray-500 mt-2">
                Here's what's happening in your organization today.
            </p>
        </div>

    </div>

    <!-- ========================================================= -->
    <!-- HR STATISTICS -->
    <!-- ========================================================= -->

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5 gap-6">

        <!-- Card 1 -->

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <div class="text-xs text-gray-500 font-semibold">
                        Total Employees
                    </div>

                    <h2 class="text-4xl font-bold mt-2 text-gray-900">
                        256
                    </h2>

                    <p class="text-sm text-green-600 mt-3 font-medium">
                        ↑ 12 this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-2xl">
                    👥
                </div>

            </div>

        </div>

        <!-- Card 2 -->

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <div class="text-xs text-gray-500 font-semibold">
                        Present Today
                    </div>

                    <h2 class="text-4xl font-bold mt-2 text-gray-900">
                        245
                    </h2>

                    <p class="text-sm text-blue-600 mt-3 font-medium">
                        96% Attendance
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                    ✅
                </div>

            </div>

        </div>

        <!-- Card 3 -->

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <div class="text-xs text-gray-500 font-semibold">
                        On Leave
                    </div>

                    <h2 class="text-4xl font-bold mt-2 text-gray-900">
                        8
                    </h2>

                    <p class="text-sm text-orange-500 mt-3 font-medium">
                        3.1% of total
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center text-2xl">
                    🏖️
                </div>

            </div>

        </div>

        <!-- Card 4 -->

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <div class="text-xs text-gray-500 font-semibold">
                        Pending Leaves
                    </div>

                    <h2 class="text-4xl font-bold mt-2 text-gray-900">
                        5
                    </h2>

                    <p class="text-sm text-green-600 mt-3 font-medium">
                        Requires Approval
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                    📄
                </div>

            </div>

        </div>

        <!-- Card 5 -->

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <div class="text-xs text-gray-500 font-semibold">
                        Total Payroll
                    </div>

                    <h2 class="text-3xl font-bold mt-2 text-gray-900">
                        ₹12,45,000
                    </h2>

                    <p class="text-sm text-purple-600 mt-3 font-medium">
                        This Month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-2xl">
                    💳
                </div>

            </div>

        </div>

    </div>

    <!-- Attendance Overview starts below -->

    <!-- ========================================================= -->
<!-- ATTENDANCE + DEPARTMENT + QUICK ACTIONS -->
<!-- ========================================================= -->

<div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

    <!-- ========================================================= -->
    <!-- ATTENDANCE OVERVIEW -->
    <!-- ========================================================= -->

    <div class="xl:col-span-5 bg-white rounded-3xl shadow-lg p-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Attendance Overview
                </h2>

                <p class="text-gray-500 mt-1">
                    Employee attendance this month
                </p>

            </div>

            <button class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                This Month
            </button>

        </div>

        <div class="flex flex-col lg:flex-row items-center gap-8">

            <div>

                <div id="attendanceChart" class="w-[260px] h-[260px]"></div>

            </div>

            <div class="flex-1 space-y-5">

                <div>

                    <div class="flex justify-between mb-2">

                        <span class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            Present
                        </span>

                        <span class="font-bold">240</span>

                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-green-500 h-3 rounded-full w-[94%]"></div>
                    </div>

                </div>

                <div>

                    <div class="flex justify-between mb-2">

                        <span class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            Absent
                        </span>

                        <span class="font-bold">10</span>

                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-red-500 h-3 rounded-full w-[4%]"></div>
                    </div>

                </div>

                <div>

                    <div class="flex justify-between mb-2">

                        <span class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                            Leave
                        </span>

                        <span class="font-bold">6</span>

                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-yellow-500 h-3 rounded-full w-[2%]"></div>
                    </div>

                </div>

                <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">

                    <p class="text-blue-700 font-medium">
                        📈 Attendance improved by 4% compared to last month.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- ========================================================= -->
    <!-- DEPARTMENT DISTRIBUTION -->
    <!-- ========================================================= -->

    <div class="xl:col-span-4 bg-white rounded-3xl shadow-lg p-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Departments
                </h2>

                <p class="text-gray-500 mt-1">
                    Employee Distribution
                </p>

            </div>

        </div>

        <div id="departmentChart" class="h-[320px]"></div>

    </div>

    <!-- ========================================================= -->
    <!-- QUICK ACTIONS -->
    <!-- ========================================================= -->

    <div class="xl:col-span-3">

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Quick Actions
            </h2>

            <div class="space-y-4">

                <a href="{{ route('employees.create') }}"
                   class="flex items-center justify-between rounded-2xl bg-blue-50 hover:bg-blue-100 p-4 transition">

                    <span>👥 Add Employee</span>

                    <span>→</span>

                </a>

                <a href="{{ route('leaves.create') }}"
                   class="flex items-center justify-between rounded-2xl bg-green-50 hover:bg-green-100 p-4 transition">

                    <span>🌴 Apply Leave</span>

                    <span>→</span>

                </a>
                <a href="{{ route('attendance.index') }}"
   class="flex items-center justify-between rounded-2xl bg-yellow-50 hover:bg-yellow-100 p-4 transition">

    <span>🕒 Mark Attendance</span>

    <span>→</span>

</a>

                <a href="{{ route('payments.index') }}"
                   class="flex items-center justify-between rounded-2xl bg-purple-50 hover:bg-purple-100 p-4 transition">

                    <span>💰 Payroll</span>

                    <span>→</span>

                </a>

                 <a href="{{ route('reports.index') }}"
   class="flex items-center justify-between rounded-2xl bg-pink-50 hover:bg-pink-100 p-4 transition">

    <span>📄 Reports</span>

    <span>→</span>

</a>

            </div>

        </div>

    </div>

</div>
<!-- ========================================================= -->
<!-- RECENT EMPLOYEES | LEAVE REQUESTS | PAYROLL SUMMARY -->
<!-- ========================================================= -->

<div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mt-6">

    <!-- ========================================================= -->
    <!-- RECENT EMPLOYEES -->
    <!-- ========================================================= -->

    <div class="xl:col-span-4 bg-white rounded-3xl shadow-lg p-6">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold">
                Recent Employees
            </h2>

            <a href="{{ route('employees.index') }}"
               class="text-blue-600 hover:underline font-semibold">
                View All
            </a>

        </div>

        <div class="space-y-5">

            @for($i=1;$i<=5;$i++)

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <img
                        src="https://i.pravatar.cc/60?img={{ $i }}"
                        class="w-14 h-14 rounded-full shadow">

                    <div>

                        <h3 class="font-bold">
                            Employee {{ $i }}
                        </h3>

                        <p class="text-gray-500 text-sm">
                            Software Engineer
                        </p>

                    </div>

                </div>

                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                    Active
                </span>

            </div>

            @endfor

        </div>

    </div>

    <!-- ========================================================= -->
    <!-- LEAVE REQUESTS -->
    <!-- ========================================================= -->

    <div class="xl:col-span-4 bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Leave Requests
            </h2>

            <a href="{{ route('leaves.index') }}"
               class="text-blue-600 hover:underline font-semibold">
                View All
            </a>

        </div>

        <div class="space-y-5">

            <div class="flex justify-between items-center">

                <div>

                    <h4 class="font-bold">
                        Rahul Sharma
                    </h4>

                    <p class="text-gray-500">
                        Annual Leave
                    </p>

                </div>

                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                    Pending
                </span>

            </div>

            <div class="flex justify-between items-center">

                <div>

                    <h4 class="font-bold">
                        Sneha Patel
                    </h4>

                    <p class="text-gray-500">
                        Sick Leave
                    </p>

                </div>

                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                    Approved
                </span>

            </div>

            <div class="flex justify-between items-center">

                <div>

                    <h4 class="font-bold">
                        Amit Verma
                    </h4>

                    <p class="text-gray-500">
                        Casual Leave
                    </p>

                </div>

                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                    Rejected
                </span>

            </div>

        </div>

    </div>

    <!-- ========================================================= -->
    <!-- PAYROLL SUMMARY -->
    <!-- ========================================================= -->

    <div class="xl:col-span-4 bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Payroll Summary
            </h2>

            <button class="px-4 py-2 bg-gray-100 rounded-xl">
                This Month
            </button>

        </div>

        <h2 class="text-5xl font-bold text-blue-600">
            ₹12,45,000
        </h2>

        <p class="text-gray-500 mt-2">
            Total Payroll
        </p>

        <div class="grid grid-cols-2 gap-6 mt-8">

            <div>

                <p class="text-gray-500">
                    Net Salary
                </p>

                <h3 class="text-2xl font-bold">
                    ₹8,75,000
                </h3>

            </div>

            <div>

                <p class="text-gray-500">
                    Deductions
                </p>

                <h3 class="text-2xl font-bold">
                    ₹3,70,000
                </h3>

            </div>

            <div>

                <p class="text-gray-500">
                    Employees
                </p>

                <h3 class="text-2xl font-bold">
                    256
                </h3>

            </div>

            <div>

                <p class="text-gray-500">
                    Last Payroll
                </p>

                <h3 class="text-2xl font-bold">
                    12 Jul 2026
                </h3>

            </div>

        </div>

    </div>

</div>
<!-- ========================================================= -->
<!-- BIRTHDAYS | HOLIDAYS | NOTIFICATIONS -->
<!-- ========================================================= -->

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">

    <!-- ========================================================= -->
    <!-- UPCOMING BIRTHDAYS -->
    <!-- ========================================================= -->

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold">
                🎂 Upcoming Birthdays
            </h2>

            <a href="{{ route('employees.index') }}">
    View All
</a>

        </div>

        <div class="space-y-5">

            @for($i=1;$i<=4;$i++)

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <img src="https://i.pravatar.cc/60?img={{ $i+10 }}"
                         class="w-14 h-14 rounded-full shadow">

                    <div>

                        <h3 class="font-bold">
                            Employee {{ $i }}
                        </h3>

                        <p class="text-gray-500">
                            {{ now()->addDays($i)->format('d M') }}
                        </p>

                    </div>

                </div>

                <span class="text-2xl">🎉</span>

            </div>

            @endfor

        </div>

    </div>

    <!-- ========================================================= -->
    <!-- UPCOMING HOLIDAYS -->
    <!-- ========================================================= -->

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            📅 Upcoming Holidays
        </h2>

        <div class="space-y-5">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="font-bold">
                        Independence Day
                    </h3>

                    <p class="text-gray-500">
                        15 August
                    </p>

                </div>

                <span class="text-2xl">🇮🇳</span>

            </div>

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="font-bold">
                        Ganesh Chaturthi
                    </h3>

                    <p class="text-gray-500">
                        27 August
                    </p>

                </div>

                <span class="text-2xl">🪔</span>

            </div>

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="font-bold">
                        Gandhi Jayanti
                    </h3>

                    <p class="text-gray-500">
                        2 October
                    </p>

                </div>

                <span class="text-2xl">🌼</span>

            </div>

        </div>

    </div>

    <!-- ========================================================= -->
    <!-- NOTIFICATIONS -->
    <!-- ========================================================= -->

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            🔔 Notifications
        </h2>

        <div class="space-y-6">

            <div class="flex gap-4">

                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                    👤
                </div>

                <div>

                    <h4 class="font-bold">
                        New Employee Joined
                    </h4>

                    <p class="text-gray-500">
                        Rahul joined the IT Department.
                    </p>

                </div>

            </div>

            <div class="flex gap-4">

                <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">
                    📄
                </div>

                <div>

                    <h4 class="font-bold">
                        Leave Request
                    </h4>

                    <p class="text-gray-500">
                        5 leave requests need approval.
                    </p>

                </div>

            </div>

            <div class="flex gap-4">

                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                    💰
                </div>

                <div>

                    <h4 class="font-bold">
                        Payroll Generated
                    </h4>

                    <p class="text-gray-500">
                        Monthly payroll completed successfully.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- ========================================================= -->
<!-- HR INSIGHTS -->
<!-- ========================================================= -->

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">

    <!-- ========================================================= -->
    <!-- MONTHLY ATTENDANCE -->
    <!-- ========================================================= -->

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    📈 Monthly Attendance
                </h2>

                <p class="text-gray-500 mt-1">
                    Last 12 Months
                </p>

            </div>

            <button class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                2026
            </button>

        </div>

        <div id="attendanceTrendChart" class="h-[350px]"></div>

    </div>

    <!-- ========================================================= -->
    <!-- TOP PERFORMERS -->
    <!-- ========================================================= -->

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                ⭐ Top Performers
            </h2>

            <a href="{{ route('performance.index') }}">
    View All
</a>

        </div>

        @php
        $employees = [
            ['Priya Sharma','HR Manager',98],
            ['Rahul Patel','Software Developer',95],
            ['Sneha Shah','UI/UX Designer',92],
            ['Amit Kumar','Accountant',90],
        ];
        @endphp

        <div class="space-y-6">

            @foreach($employees as $employee)

            <div>

                <div class="flex justify-between mb-2">

                    <div>

                        <h3 class="font-bold text-gray-800">
                            {{ $employee[0] }}
                        </h3>

                        <p class="text-gray-500 text-sm">
                            {{ $employee[1] }}
                        </p>

                    </div>

                    <span class="font-bold text-blue-600">
                        {{ $employee[2] }}%
                    </span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div
                        class="bg-blue-600 h-3 rounded-full"
                        style="width: {{ $employee[2] }}%;">
                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

<!-- ========================================================= -->
<!-- APEX CHARTS -->
<!-- ========================================================= -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    // Attendance Donut Chart
    new ApexCharts(document.querySelector("#attendanceChart"), {
        chart: {
            type: 'donut',
            height: 280
        },
        series: [240, 10, 6],
        labels: ['Present', 'Absent', 'Leave'],
        colors: ['#22c55e', '#ef4444', '#f59e0b'],
        legend: {
            position: 'bottom'
        }
    }).render();

    // Department Pie Chart
    new ApexCharts(document.querySelector("#departmentChart"), {
        chart: {
            type: 'pie',
            height: 320
        },
        series: [35, 20, 15, 18, 12],
        labels: [
            'IT',
            'HR',
            'Finance',
            'Sales',
            'Marketing'
        ],
        colors: [
            '#2563eb',
            '#06b6d4',
            '#22c55e',
            '#f97316',
            '#8b5cf6'
        ]
    }).render();

    // Attendance Trend
    new ApexCharts(document.querySelector("#attendanceTrendChart"), {
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },

        series: [{
            name: 'Attendance',
            data: [85,88,90,91,93,95,94,96,97,95,96,98]
        }],

        xaxis: {
            categories: [
                'Jan','Feb','Mar','Apr',
                'May','Jun','Jul','Aug',
                'Sep','Oct','Nov','Dec'
            ]
        },

        stroke: {
            curve: 'smooth',
            width: 4
        },

        fill: {
            opacity: 0.25
        },

        colors: ['#2563eb']

    }).render();

});

</script>

@endsection