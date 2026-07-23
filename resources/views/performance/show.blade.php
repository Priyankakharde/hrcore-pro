@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================================= -->
    <!-- PAGE HEADER -->
    <!-- ================================= -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                Employee Performance Report

            </h1>

            <p class="text-gray-500 mt-2">

                View complete employee performance details.

            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('performance.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-xl">

                ← Back

            </a>

            <a href="{{ route('performance.edit',$performance) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

                Edit

            </a>

        </div>

    </div>

    <!-- ================================= -->
    <!-- EMPLOYEE INFORMATION -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8 mb-8">

        <div class="flex items-center gap-6">

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode($performance->employee->name) }}&background=2563eb&color=fff&size=128"
                class="w-24 h-24 rounded-full">

            <div>

                <h2 class="text-3xl font-bold">

                    {{ $performance->employee->name }}

                </h2>

                <p class="text-gray-500 mt-1">

                    {{ $performance->employee->department }}

                </p>

                <p class="text-gray-500">

                    Review :
                    {{ $performance->review_month }}
                    {{ $performance->review_year }}

                </p>

            </div>

        </div>

    </div>

    <!-- ================================= -->
    <!-- SUMMARY CARDS -->
    <!-- ================================= -->

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Overall Score -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Overall Score

            </p>

            <h2 class="text-5xl font-bold text-blue-600 mt-4">

                {{ $performance->overall_score }}%

            </h2>

        </div>

        <!-- Rating -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Performance Rating

            </p>

            <h2 class="text-4xl font-bold text-green-600 mt-4">

                {{ $performance->rating }}

            </h2>

        </div>

        <!-- Next Review -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Next Review

            </p>

            <h2 class="text-2xl font-bold mt-4">

                {{ optional($performance->next_review_date)->format('d M Y') }}

            </h2>

        </div>

    </div>

    <!-- ================================= -->
    <!-- PERFORMANCE SCORES -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8">

        <h2 class="text-2xl font-bold mb-8">

            Performance Scores

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Attendance -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Attendance</span>

                    <span>{{ $performance->attendance }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-blue-600 h-3 rounded-full"
                         style="width: {{ $performance->attendance }}%"></div>

                </div>

            </div>

            <!-- Task Completion -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Task Completion</span>

                    <span>{{ $performance->task_completion }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-green-600 h-3 rounded-full"
                         style="width: {{ $performance->task_completion }}%"></div>

                </div>

            </div>

            <!-- Productivity -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Productivity</span>

                    <span>{{ $performance->productivity }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-indigo-600 h-3 rounded-full"
                         style="width: {{ $performance->productivity }}%"></div>

                </div>

            </div>

            <!-- Communication -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Communication</span>

                    <span>{{ $performance->communication }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-purple-600 h-3 rounded-full"
                         style="width: {{ $performance->communication }}%"></div>

                </div>

            </div>

            <!-- Teamwork -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Teamwork</span>

                    <span>{{ $performance->teamwork }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-pink-600 h-3 rounded-full"
                         style="width: {{ $performance->teamwork }}%"></div>

                </div>

            </div>

            <!-- Leadership -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Leadership</span>

                    <span>{{ $performance->leadership }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-yellow-500 h-3 rounded-full"
                         style="width: {{ $performance->leadership }}%"></div>

                </div>

            </div>

            <!-- Problem Solving -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Problem Solving</span>

                    <span>{{ $performance->problem_solving }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-orange-500 h-3 rounded-full"
                         style="width: {{ $performance->problem_solving }}%"></div>

                </div>

            </div>

            <!-- Punctuality -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Punctuality</span>

                    <span>{{ $performance->punctuality }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-cyan-600 h-3 rounded-full"
                         style="width: {{ $performance->punctuality }}%"></div>

                </div>

            </div>

            <!-- Discipline -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Discipline</span>

                    <span>{{ $performance->discipline }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-red-600 h-3 rounded-full"
                         style="width: {{ $performance->discipline }}%"></div>

                </div>

            </div>

            <!-- Innovation -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Innovation</span>

                    <span>{{ $performance->innovation }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-emerald-600 h-3 rounded-full"
                         style="width: {{ $performance->innovation }}%"></div>

                </div>

            </div>

            <!-- Learning -->

            <div>

                <div class="flex justify-between mb-2">

                    <span class="font-semibold">Learning</span>

                    <span>{{ $performance->learning }}%</span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="bg-teal-600 h-3 rounded-full"
                         style="width: {{ $performance->learning }}%"></div>

                </div>

            </div>

        </div>

    </div>

    <!-- ================================= -->
    <!-- MANAGER REVIEW STARTS IN PART 3 -->
        <!-- ================================= -->
    <!-- MANAGER REVIEW -->
    <!-- ================================= -->

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        <!-- Strengths -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="text-xl font-bold text-green-600 mb-4">

                💪 Strengths

            </h3>

            <p class="text-gray-700">

                {{ $performance->strengths ?? 'No strengths added.' }}

            </p>

        </div>

        <!-- Weaknesses -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="text-xl font-bold text-red-600 mb-4">

                ⚠️ Weaknesses

            </h3>

            <p class="text-gray-700">

                {{ $performance->weaknesses ?? 'No weaknesses added.' }}

            </p>

        </div>

        <!-- Manager Remarks -->

        <div class="bg-white rounded-2xl shadow-sm p-6 lg:col-span-2">

            <h3 class="text-xl font-bold text-blue-600 mb-4">

                📝 Manager Remarks

            </h3>

            <p class="text-gray-700 whitespace-pre-line">

                {{ $performance->remarks ?? 'No remarks available.' }}

            </p>

        </div>

        <!-- Goals -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="text-xl font-bold text-indigo-600 mb-4">

                🎯 Goals

            </h3>

            <p class="text-gray-700 whitespace-pre-line">

                {{ $performance->goals ?? 'No goals assigned.' }}

            </p>

        </div>

        <!-- Improvement Plan -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="text-xl font-bold text-orange-600 mb-4">

                📈 Improvement Plan

            </h3>

            <p class="text-gray-700 whitespace-pre-line">

                {{ $performance->improvement_plan ?? 'No improvement plan available.' }}

            </p>

        </div>

    </div>

    <!-- ================================= -->
    <!-- ACTION BUTTONS -->
    <!-- ================================= -->

    <div class="flex justify-end gap-4 mt-8">

        <button
            onclick="window.print()"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

            🖨 Print

        </button>

        <a
            href="{{ route('performance.edit', $performance) }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

            ✏ Edit

        </a>

        <form
            action="{{ route('performance.destroy', $performance) }}"
            method="POST">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Are you sure you want to delete this performance review?')"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">

                🗑 Delete

            </button>

        </form>

    </div>

</div>

@endsection