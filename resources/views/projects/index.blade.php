@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Project Management
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Manage all company projects in one dashboard
            </p>

        </div>

        <!-- CREATE BUTTON -->
        <a href="{{ route('projects.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition duration-300">

            + Create Project

        </a>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6">

        <!-- TOTAL -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400">
                Total Projects
            </p>

            <h2 class="text-5xl font-bold mt-4 text-gray-800">
                {{ $totalProjects }}
            </h2>

        </div>

        <!-- ACTIVE -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-blue-500">
                Active
            </p>

            <h2 class="text-5xl font-bold mt-4 text-blue-600">
                {{ $activeProjects }}
            </h2>

        </div>

        <!-- COMPLETED -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-green-500">
                Completed
            </p>

            <h2 class="text-5xl font-bold mt-4 text-green-600">
                {{ $completedProjects }}
            </h2>

        </div>

        <!-- PENDING -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-yellow-500">
                Pending
            </p>

            <h2 class="text-5xl font-bold mt-4 text-yellow-500">
                {{ $pendingProjects }}
            </h2>

        </div>

        <!-- ON HOLD -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-orange-500">
                On Hold
            </p>

            <h2 class="text-5xl font-bold mt-4 text-orange-500">
                {{ $onHoldProjects }}
            </h2>

        </div>

        <!-- BUDGET -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-purple-500">
                Total Budget
            </p>

            <h2 class="text-3xl font-bold mt-6 text-purple-600">
                ${{ number_format($totalBudget, 0) }}
            </h2>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <form method="GET"
              action="{{ route('projects.index') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-5">

            <!-- SEARCH -->
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search project..."
                   class="rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

            <!-- STATUS -->
            <select name="status"
                    class="rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                <option value="">All Status</option>

                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="On Hold" {{ request('status') == 'On Hold' ? 'selected' : '' }}>
                    On Hold
                </option>

                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

            <!-- PRIORITY -->
            <select name="priority"
                    class="rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                <option value="">All Priority</option>

                <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>
                    High
                </option>

                <option value="Critical" {{ request('priority') == 'Critical' ? 'selected' : '' }}>
                    Critical
                </option>

            </select>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-semibold transition">

                Filter Projects

            </button>

        </form>

    </div>

    <!-- PROJECT LIST -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        @forelse($projects as $project)

        @php

            $statusClass = match($project->status) {

                'Active' => 'bg-blue-100 text-blue-600',

                'Completed' => 'bg-green-100 text-green-600',

                'Pending' => 'bg-yellow-100 text-yellow-600',

                'On Hold' => 'bg-orange-100 text-orange-600',

                default => 'bg-red-100 text-red-600'
            };

            $priorityClass = match($project->priority) {

                'Low' => 'bg-green-100 text-green-600',

                'Medium' => 'bg-blue-100 text-blue-600',

                'High' => 'bg-orange-100 text-orange-600',

                'Critical' => 'bg-red-100 text-red-600',

                default => 'bg-gray-100 text-gray-600'
            };

        @endphp

        <!-- CARD -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300">

            <!-- TOP -->
            <div class="flex justify-between items-start">

                <div>

                    <div class="flex flex-wrap items-center gap-3 mb-4">

                        <!-- CODE -->
                        <span class="px-4 py-2 rounded-full bg-gray-100 text-gray-600 text-sm font-medium">

                            {{ $project->project_code }}

                        </span>

                        <!-- PRIORITY -->
                        <span class="px-4 py-2 rounded-full text-sm font-medium {{ $priorityClass }}">

                            {{ $project->priority }}

                        </span>

                    </div>

                    <!-- TITLE -->
                    <h2 class="text-3xl font-bold text-gray-800">

                        {{ $project->project_name }}

                    </h2>

                    <p class="text-gray-400 mt-2">

                        Client: {{ $project->client_name }}

                    </p>

                </div>

                <!-- STATUS -->
                <span class="px-5 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">

                    {{ $project->status }}

                </span>

            </div>

            <!-- DESCRIPTION -->
            <p class="mt-6 text-gray-500 leading-relaxed">

                {{ $project->description }}

            </p>

            <!-- DETAILS -->
            <div class="grid grid-cols-2 gap-6 mt-8">

                <div>

                    <p class="text-gray-400 text-sm">
                        Project Manager
                    </p>

                    <h3 class="font-semibold text-gray-700 mt-1">
                        {{ $project->project_manager }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-sm">
                        Department
                    </p>

                    <h3 class="font-semibold text-gray-700 mt-1">
                        {{ $project->department }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-sm">
                        Budget
                    </p>

                    <h3 class="font-semibold text-gray-700 mt-1">
                        ${{ number_format($project->budget, 0) }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-sm">
                        Deadline
                    </p>

                    <h3 class="font-semibold text-gray-700 mt-1">
                        {{ $project->deadline }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-sm">
                        Technology
                    </p>

                    <h3 class="font-semibold text-gray-700 mt-1">
                        {{ $project->technology }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-sm">
                        Team Size
                    </p>

                    <h3 class="font-semibold text-gray-700 mt-1">
                        {{ $project->team_size }} Members
                    </h3>

                </div>

            </div>

            <!-- PROGRESS -->
            <div class="mt-8">

                <div class="flex justify-between mb-3">

                    <p class="text-gray-500 font-medium">
                        Project Progress
                    </p>

                    <p class="font-bold text-blue-600">
                        {{ $project->progress }}%
                    </p>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">

                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-500"
                         style="width: {{ $project->progress }}%"></div>

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="flex flex-wrap gap-3 mt-8">

                <!-- VIEW -->
                <a href="{{ route('projects.show', $project->id) }}"
                   class="px-5 py-3 rounded-xl bg-blue-100 text-blue-600 font-medium hover:bg-blue-200 transition">

                    View

                </a>

                <!-- EDIT -->
                <a href="{{ route('projects.edit', $project->id) }}"
                   class="px-5 py-3 rounded-xl bg-purple-100 text-purple-600 font-medium hover:bg-purple-200 transition">

                    Edit

                </a>

                <!-- COMPLETE -->
                <form action="{{ route('projects.complete', $project->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <button class="px-5 py-3 rounded-xl bg-green-100 text-green-600 font-medium hover:bg-green-200 transition">

                        Complete

                    </button>

                </form>

                <!-- HOLD -->
                <form action="{{ route('projects.hold', $project->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <button class="px-5 py-3 rounded-xl bg-yellow-100 text-yellow-600 font-medium hover:bg-yellow-200 transition">

                        Hold

                    </button>

                </form>

                <!-- DELETE -->
                <form action="{{ route('projects.destroy', $project->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Delete this project?')"
                            class="px-5 py-3 rounded-xl bg-red-100 text-red-600 font-medium hover:bg-red-200 transition">

                        Delete

                    </button>

                </form>

            </div>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="bg-white rounded-3xl p-20 text-center col-span-2 shadow-sm">

            <div class="text-8xl mb-8">
                📁
            </div>

            <h2 class="text-4xl font-bold text-gray-700">

                No Projects Found

            </h2>

            <p class="text-gray-400 mt-4 text-lg">

                Create your first company project

            </p>

            <a href="{{ route('projects.create') }}"
               class="inline-block mt-10 bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                + Create Project

            </a>

        </div>

        @endforelse

    </div>

</div>

@endsection