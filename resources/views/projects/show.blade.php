@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Project Details
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Complete project information dashboard
            </p>

        </div>

        <!-- BACK -->
        <a href="{{ route('projects.index') }}"
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-4 rounded-2xl font-semibold transition">

            Back

        </a>

    </div>

    <!-- PROJECT CARD -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <!-- TOP -->
        <div class="flex flex-col xl:flex-row xl:items-start xl:justify-between gap-8">

            <div>

                <!-- BADGES -->
                <div class="flex flex-wrap gap-3 mb-5">

                    <span class="px-5 py-2 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold">

                        {{ $project->project_code }}

                    </span>

                    <span class="px-5 py-2 rounded-full bg-purple-100 text-purple-600 text-sm font-semibold">

                        {{ $project->priority }}

                    </span>

                    @php

                    $statusClass = match($project->status) {

                        'Active' => 'bg-blue-100 text-blue-600',

                        'Completed' => 'bg-green-100 text-green-600',

                        'Pending' => 'bg-yellow-100 text-yellow-600',

                        'On Hold' => 'bg-orange-100 text-orange-600',

                        default => 'bg-red-100 text-red-600'
                    };

                    @endphp

                    <span class="px-5 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">

                        {{ $project->status }}

                    </span>

                </div>

                <!-- TITLE -->
                <h2 class="text-5xl font-bold text-gray-800">

                    {{ $project->project_name }}

                </h2>

                <p class="text-gray-400 mt-4 text-lg">

                    Client: {{ $project->client_name }}

                </p>

            </div>

            <!-- ACTIONS -->
            <div class="flex flex-wrap gap-3">

                <!-- EDIT -->
                <a href="{{ route('projects.edit', $project->id) }}"
                   class="px-6 py-4 rounded-2xl bg-purple-100 text-purple-600 font-semibold hover:bg-purple-200 transition">

                    Edit Project

                </a>

                <!-- COMPLETE -->
                <form action="{{ route('projects.complete', $project->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <button class="px-6 py-4 rounded-2xl bg-green-100 text-green-600 font-semibold hover:bg-green-200 transition">

                        Complete

                    </button>

                </form>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="mt-10">

            <h3 class="text-2xl font-bold text-gray-800 mb-5">
                Project Description
            </h3>

            <p class="text-gray-500 leading-relaxed text-lg">

                {{ $project->description }}

            </p>

        </div>

        <!-- DETAILS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mt-12">

            <!-- MANAGER -->
            <div class="bg-gray-50 rounded-3xl p-6">

                <p class="text-gray-400 mb-3">
                    Project Manager
                </p>

                <h3 class="text-2xl font-bold text-gray-800">

                    {{ $project->project_manager }}

                </h3>

            </div>

            <!-- DEPARTMENT -->
            <div class="bg-gray-50 rounded-3xl p-6">

                <p class="text-gray-400 mb-3">
                    Department
                </p>

                <h3 class="text-2xl font-bold text-gray-800">

                    {{ $project->department }}

                </h3>

            </div>

            <!-- TECHNOLOGY -->
            <div class="bg-gray-50 rounded-3xl p-6">

                <p class="text-gray-400 mb-3">
                    Technology
                </p>

                <h3 class="text-2xl font-bold text-gray-800">

                    {{ $project->technology }}

                </h3>

            </div>

            <!-- TEAM SIZE -->
            <div class="bg-gray-50 rounded-3xl p-6">

                <p class="text-gray-400 mb-3">
                    Team Size
                </p>

                <h3 class="text-2xl font-bold text-gray-800">

                    {{ $project->team_size }} Members

                </h3>

            </div>

        </div>

        <!-- TIMELINE -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

            <!-- START -->
            <div class="bg-blue-50 rounded-3xl p-6">

                <p class="text-blue-400 mb-3">
                    Start Date
                </p>

                <h3 class="text-2xl font-bold text-blue-700">

                    {{ $project->start_date }}

                </h3>

            </div>

            <!-- DEADLINE -->
            <div class="bg-red-50 rounded-3xl p-6">

                <p class="text-red-400 mb-3">
                    Deadline
                </p>

                <h3 class="text-2xl font-bold text-red-700">

                    {{ $project->deadline }}

                </h3>

            </div>

            <!-- COMPLETED -->
            <div class="bg-green-50 rounded-3xl p-6">

                <p class="text-green-400 mb-3">
                    Completed Date
                </p>

                <h3 class="text-2xl font-bold text-green-700">

                    {{ $project->completed_date ?? 'Not Completed' }}

                </h3>

            </div>

        </div>

        <!-- BUDGET -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

            <!-- TOTAL -->
            <div class="bg-purple-50 rounded-3xl p-6">

                <p class="text-purple-400 mb-3">
                    Total Budget
                </p>

                <h3 class="text-3xl font-bold text-purple-700">

                    ${{ number_format($project->budget, 0) }}

                </h3>

            </div>

            <!-- SPENT -->
            <div class="bg-orange-50 rounded-3xl p-6">

                <p class="text-orange-400 mb-3">
                    Spent Amount
                </p>

                <h3 class="text-3xl font-bold text-orange-700">

                    ${{ number_format($project->spent_amount, 0) }}

                </h3>

            </div>

        </div>

        <!-- PROGRESS -->
        <div class="mt-12">

            <div class="flex justify-between mb-4">

                <h3 class="text-2xl font-bold text-gray-800">
                    Project Progress
                </h3>

                <span class="text-2xl font-bold text-blue-600">

                    {{ $project->progress }}%

                </span>

            </div>

            <div class="w-full bg-gray-200 rounded-full h-5 overflow-hidden">

                <div class="bg-blue-600 h-5 rounded-full"
                     style="width: {{ $project->progress }}%"></div>

            </div>

        </div>

        <!-- TASK STATS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

            <!-- TOTAL TASKS -->
            <div class="bg-gray-50 rounded-3xl p-6">

                <p class="text-gray-400 mb-3">
                    Total Tasks
                </p>

                <h3 class="text-3xl font-bold text-gray-800">

                    {{ $project->total_tasks }}

                </h3>

            </div>

            <!-- COMPLETED TASKS -->
            <div class="bg-green-50 rounded-3xl p-6">

                <p class="text-green-400 mb-3">
                    Completed Tasks
                </p>

                <h3 class="text-3xl font-bold text-green-700">

                    {{ $project->completed_tasks }}

                </h3>

            </div>

        </div>

    </div>

</div>

@endsection