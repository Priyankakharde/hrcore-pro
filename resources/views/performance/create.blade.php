@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- =============================== -->
    <!-- PAGE HEADER -->
    <!-- =============================== -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Add Employee Performance
            </h1>

            <p class="text-gray-500 mt-1">
                Create a new employee performance review.
            </p>

        </div>

        <a href="{{ route('performance.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-xl">

            ← Back

        </a>

    </div>

    <!-- =============================== -->
    <!-- VALIDATION ERRORS -->
    <!-- =============================== -->

    @if ($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-5 mb-6">

            <h3 class="font-bold mb-3">

                Please fix the following errors:

            </h3>

            <ul class="list-disc ml-6">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- =============================== -->
    <!-- FORM -->
    <!-- =============================== -->

    <form
        action="{{ route('performance.store') }}"
        method="POST">

        @csrf

        <div class="bg-white rounded-2xl shadow-sm p-8">

            <!-- Employee Information -->

            <h2 class="text-2xl font-bold mb-6">

                Employee Information

            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Employee -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Employee

                    </label>

                    <select
                        name="employee_id"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="">

                            Select Employee

                        </option>

                        @foreach($employees as $employee)

                            <option
                                value="{{ $employee->id }}"
                                {{ old('employee_id')==$employee->id ? 'selected' : '' }}>

                                {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Month -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Review Month

                    </label>

                    <select
                        name="review_month"
                        class="w-full border rounded-xl px-4 py-3">

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

                </div>

                <!-- Year -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Review Year

                    </label>

                    <input
                        type="number"
                        name="review_year"
                        value="{{ date('Y') }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

            </div>

            <!-- =================================== -->
            <!-- PERFORMANCE SCORES -->
            <!-- =================================== -->

            <div class="mt-10">

                <h2 class="text-2xl font-bold mb-6">

                    Performance Scores

                </h2>

                <p class="text-gray-500 mb-8">

                    Give each category a score between 0 and 100.

                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- Attendance -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Attendance

                        </label>

                        <input
                            type="number"
                            name="attendance"
                            min="0"
                            max="100"
                            value="{{ old('attendance',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Task Completion -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Task Completion

                        </label>

                        <input
                            type="number"
                            name="task_completion"
                            min="0"
                            max="100"
                            value="{{ old('task_completion',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Productivity -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Productivity

                        </label>

                        <input
                            type="number"
                            name="productivity"
                            min="0"
                            max="100"
                            value="{{ old('productivity',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Communication -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Communication

                        </label>

                        <input
                            type="number"
                            name="communication"
                            min="0"
                            max="100"
                            value="{{ old('communication',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Teamwork -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Teamwork

                        </label>

                        <input
                            type="number"
                            name="teamwork"
                            min="0"
                            max="100"
                            value="{{ old('teamwork',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Leadership -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Leadership

                        </label>

                        <input
                            type="number"
                            name="leadership"
                            min="0"
                            max="100"
                            value="{{ old('leadership',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Problem Solving -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Problem Solving

                        </label>

                        <input
                            type="number"
                            name="problem_solving"
                            min="0"
                            max="100"
                            value="{{ old('problem_solving',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Punctuality -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Punctuality

                        </label>

                        <input
                            type="number"
                            name="punctuality"
                            min="0"
                            max="100"
                            value="{{ old('punctuality',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Discipline -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Discipline

                        </label>

                        <input
                            type="number"
                            name="discipline"
                            min="0"
                            max="100"
                            value="{{ old('discipline',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Innovation -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Innovation

                        </label>

                        <input
                            type="number"
                            name="innovation"
                            min="0"
                            max="100"
                            value="{{ old('innovation',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Learning -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Learning

                        </label>

                        <input
                            type="number"
                            name="learning"
                            min="0"
                            max="100"
                            value="{{ old('learning',0) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                </div>

            </div>

            <!-- =================================== -->
            <!-- MANAGER REVIEW -->
            <!-- =================================== -->

            <div class="mt-10">

                <h2 class="text-2xl font-bold mb-6">

                    Manager Review

                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Strengths -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Strengths

                        </label>

                        <textarea
                            name="strengths"
                            rows="4"
                            class="w-full border rounded-xl px-4 py-3">{{ old('strengths') }}</textarea>

                    </div>

                    <!-- Weaknesses -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Weaknesses

                        </label>

                        <textarea
                            name="weaknesses"
                            rows="4"
                            class="w-full border rounded-xl px-4 py-3">{{ old('weaknesses') }}</textarea>

                    </div>

                    <!-- Manager Remarks -->

                    <div class="md:col-span-2">

                        <label class="block mb-2 font-semibold">

                            Manager Remarks

                        </label>

                        <textarea
                            name="remarks"
                            rows="4"
                            class="w-full border rounded-xl px-4 py-3">{{ old('remarks') }}</textarea>

                    </div>

                    <!-- Goals -->

                    <div class="md:col-span-2">

                        <label class="block mb-2 font-semibold">

                            Goals

                        </label>

                        <textarea
                            name="goals"
                            rows="4"
                            class="w-full border rounded-xl px-4 py-3">{{ old('goals') }}</textarea>

                    </div>

                    <!-- Improvement Plan -->

                    <div class="md:col-span-2">

                        <label class="block mb-2 font-semibold">

                            Improvement Plan

                        </label>

                        <textarea
                            name="improvement_plan"
                            rows="5"
                            class="w-full border rounded-xl px-4 py-3">{{ old('improvement_plan') }}</textarea>

                    </div>

                    <!-- Next Review Date -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Next Review Date

                        </label>

                        <input
                            type="date"
                            name="next_review_date"
                            value="{{ old('next_review_date') }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                </div>

            </div>

            <!-- BUTTONS -->

            <div class="mt-10 flex justify-end gap-4">

                <a
                    href="{{ route('performance.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg">

                    Save Performance Review

                </button>

            </div>

        </div>

    </form>

</div>

@endsection