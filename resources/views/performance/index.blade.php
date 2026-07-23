@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- ========================= -->
    <!-- PAGE HEADER -->
    <!-- ========================= -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Performance Management
            </h1>

            <p class="text-gray-500 mt-1">
                Monitor employee performance, ratings and reviews.
            </p>

        </div>

        <a href="{{ route('performance.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-lg transition">

            + Add Performance

        </a>

    </div>

    <!-- ========================= -->
    <!-- SUCCESS MESSAGE -->
    <!-- ========================= -->

    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif

    <!-- ========================= -->
    <!-- STATISTICS -->
    <!-- ========================= -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Total Reviews -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Total Reviews
                    </p>

                    <h2 class="text-4xl font-bold mt-2">

                        {{ $stats['total_reviews'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    📋

                </div>

            </div>

        </div>

        <!-- Excellent -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Excellent
                    </p>

                    <h2 class="text-4xl font-bold text-green-600 mt-2">

                        {{ $stats['excellent'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    ⭐

                </div>

            </div>

        </div>

        <!-- Very Good -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Very Good
                    </p>

                    <h2 class="text-4xl font-bold text-blue-600 mt-2">

                        {{ $stats['very_good'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    🏆

                </div>

            </div>

        </div>

        <!-- Good -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Good
                    </p>

                    <h2 class="text-4xl font-bold text-indigo-600 mt-2">

                        {{ $stats['good'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    👍

                </div>

            </div>

        </div>

    </div>

    <!-- SECOND ROW -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Average -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Average
                    </p>

                    <h2 class="text-4xl font-bold text-yellow-500 mt-2">

                        {{ $stats['average'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    📈

                </div>

            </div>

        </div>

        <!-- Poor -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Poor
                    </p>

                    <h2 class="text-4xl font-bold text-red-600 mt-2">

                        {{ $stats['poor'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    📉

                </div>

            </div>

        </div>

        <!-- Average Score -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">
                        Avg Score
                    </p>

                    <h2 class="text-4xl font-bold text-purple-600 mt-2">

                        {{ $stats['avg_score'] }}

                    </h2>

                </div>

                <div class="text-5xl">

                    🎯

                </div>

            </div>

        </div>

        <!-- Performance Status -->

        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl shadow-lg p-6">

            <p class="text-lg">

                Company Performance

            </p>

            <h2 class="text-5xl font-bold mt-4">

                Excellent

            </h2>

            <p class="mt-4 text-blue-100">

                Keep motivating your employees.

            </p>

        </div>

    </div>

    <!-- SEARCH, FILTERS, TABLE & CHARTS WILL COME IN PART 2 -->
        <!-- ====================================== -->
    <!-- SEARCH & FILTER SECTION -->
    <!-- ====================================== -->

    <div class="bg-white rounded-2xl shadow-sm p-6">

        <form method="GET"
              action="{{ route('performance.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                <!-- Search -->

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Employee..."
                    class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">

                <!-- Rating -->

                <select
                    name="rating"
                    class="border rounded-xl px-4 py-3">

                    <option value="">All Ratings</option>

                    <option value="Excellent">Excellent</option>

                    <option value="Very Good">Very Good</option>

                    <option value="Good">Good</option>

                    <option value="Average">Average</option>

                    <option value="Poor">Poor</option>

                </select>

                <!-- Month -->

                <select
                    name="month"
                    class="border rounded-xl px-4 py-3">

                    <option value="">Review Month</option>

                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>

                </select>

                <!-- Department -->

                <select
                    name="department"
                    class="border rounded-xl px-4 py-3">

                    <option value="">
                        Department
                    </option>

                    <option>HR</option>

                    <option>IT</option>

                    <option>Finance</option>

                    <option>Marketing</option>

                    <option>Sales</option>

                </select>

                <!-- Buttons -->

                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-xl">

                        Search

                    </button>

                    <a href="{{ route('performance.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 px-5 rounded-xl flex items-center">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- ====================================== -->
    <!-- ACTION BUTTONS -->
    <!-- ====================================== -->

    <div class="flex justify-end gap-4">

        <button
            class="bg-green-600 text-white px-5 py-3 rounded-xl">

            Export Excel

        </button>

        <button
            class="bg-red-600 text-white px-5 py-3 rounded-xl">

            Export PDF

        </button>

        <button
            class="bg-indigo-600 text-white px-5 py-3 rounded-xl">

            Print Report

        </button>

    </div>

    <!-- ====================================== -->
    <!-- CHARTS -->
    <!-- ====================================== -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Performance Chart -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h2 class="text-xl font-bold mb-5">

                Monthly Performance

            </h2>

            <div id="performanceChart"></div>

        </div>

        <!-- Rating Distribution -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h2 class="text-xl font-bold mb-5">

                Rating Distribution

            </h2>

            <div id="ratingChart"></div>

        </div>

    </div>

    <!-- ====================================== -->
    <!-- TABLE STARTS IN PART 3 -->
        <!-- ====================================== -->
    <!-- EMPLOYEE PERFORMANCE TABLE -->
    <!-- ====================================== -->

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b">

            <h2 class="text-xl font-bold text-gray-800">
                Employee Performance Records
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Employee</th>

                        <th class="px-6 py-4 text-left">Month</th>

                        <th class="px-6 py-4 text-left">Attendance</th>

                        <th class="px-6 py-4 text-left">Task</th>

                        <th class="px-6 py-4 text-left">Score</th>

                        <th class="px-6 py-4 text-left">Rating</th>

                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($performances as $performance)

                    <tr class="border-b hover:bg-gray-50">

                        <!-- Employee -->

                        <td class="px-6 py-5">

                            <div>

                                <h3 class="font-semibold">

                                    {{ $performance->employee->name }}

                                </h3>

                                <p class="text-sm text-gray-500">

                                    {{ $performance->employee->department }}

                                </p>

                            </div>

                        </td>

                        <!-- Review -->

                        <td class="px-6 py-5">

                            {{ $performance->review_month }}

                            {{ $performance->review_year }}

                        </td>

                        <!-- Attendance -->

                        <td class="px-6 py-5">

                            {{ $performance->attendance }}%

                        </td>

                        <!-- Task -->

                        <td class="px-6 py-5">

                            {{ $performance->task_completion }}%

                        </td>

                        <!-- Overall Score -->

                        <td class="px-6 py-5">

                            <div class="w-36">

                                <div class="flex justify-between mb-1">

                                    <span>

                                        {{ $performance->overall_score }}%

                                    </span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2">

                                    <div
                                        class="bg-blue-600 h-2 rounded-full"
                                        style="width: {{ $performance->overall_score }}%">

                                    </div>

                                </div>

                            </div>

                        </td>

                        <!-- Rating -->

                        <td class="px-6 py-5">

                            @if($performance->rating == 'Excellent')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Excellent

                                </span>

                            @elseif($performance->rating == 'Very Good')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    Very Good

                                </span>

                            @elseif($performance->rating == 'Good')

                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">

                                    Good

                                </span>

                            @elseif($performance->rating == 'Average')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Average

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                    Poor

                                </span>

                            @endif

                        </td>

                        <!-- Actions -->

                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('performance.show',$performance) }}"
                                   class="bg-green-500 text-white px-3 py-2 rounded-lg">

                                    View

                                </a>

                                <a href="{{ route('performance.edit',$performance) }}"
                                   class="bg-blue-500 text-white px-3 py-2 rounded-lg">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('performance.destroy',$performance) }}"
                                    method="POST">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this performance review?')"
                                        class="bg-red-500 text-white px-3 py-2 rounded-lg">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-12 text-gray-500">

                            No performance records found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="px-6 py-4">

            {{ $performances->links() }}

        </div>

    </div>

    <!-- ====================================== -->
    <!-- JAVASCRIPT STARTS IN PART 4 -->
        <!-- ====================================== -->
    <!-- APEX CHARTS -->
    <!-- ====================================== -->

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    /*
    |--------------------------------------------------------------------------
    | Monthly Performance Chart
    |--------------------------------------------------------------------------
    */

    var performanceOptions = {

        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },

        series: [{
            name: 'Performance',
            data: [72, 76, 81, 79, 88, 92, 90, 94, 89, 91, 95, 97]
        }],

        xaxis: {

            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ]

        },

        stroke: {
            curve: 'smooth',
            width: 3
        },

        colors: ['#2563eb'],

        dataLabels: {
            enabled: false
        },

        fill: {
            opacity: 0.3
        }

    };

    new ApexCharts(
        document.querySelector("#performanceChart"),
        performanceOptions
    ).render();



    /*
    |--------------------------------------------------------------------------
    | Rating Distribution
    |--------------------------------------------------------------------------
    */

    var ratingOptions = {

        chart: {

            type: 'donut',

            height: 350

        },

        labels: [

            'Excellent',
            'Very Good',
            'Good',
            'Average',
            'Poor'

        ],

        series: [

            {{ $stats['excellent'] }},
            {{ $stats['very_good'] }},
            {{ $stats['good'] }},
            {{ $stats['average'] }},
            {{ $stats['poor'] }}

        ],

        legend: {

            position: 'bottom'

        },

        responsive: [{

            breakpoint: 480,

            options: {

                chart: {

                    width: 300

                }

            }

        }]

    };

    new ApexCharts(

        document.querySelector("#ratingChart"),

        ratingOptions

    ).render();

});

</script>

@endsection