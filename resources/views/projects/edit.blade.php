@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Edit Project
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Update project information
            </p>

        </div>

        <!-- BACK -->
        <a href="{{ route('projects.index') }}"
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-4 rounded-2xl font-semibold transition">

            Back

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <form action="{{ route('projects.update', $project->id) }}"
              method="POST"
              class="space-y-10">

            @csrf
            @method('PUT')

            <!-- BASIC INFO -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Basic Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- PROJECT NAME -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Project Name
                        </label>

                        <input type="text"
                               name="project_name"
                               value="{{ $project->project_name }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- PROJECT CODE -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Project Code
                        </label>

                        <input type="text"
                               name="project_code"
                               value="{{ $project->project_code }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- CLIENT -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Client Name
                        </label>

                        <input type="text"
                               name="client_name"
                               value="{{ $project->client_name }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- MANAGER -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Project Manager
                        </label>

                        <input type="text"
                               name="project_manager"
                               value="{{ $project->project_manager }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

            </div>

            <!-- PROJECT DETAILS -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Project Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- START DATE -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Start Date
                        </label>

                        <input type="date"
                               name="start_date"
                               value="{{ $project->start_date }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- DEADLINE -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Deadline
                        </label>

                        <input type="date"
                               name="deadline"
                               value="{{ $project->deadline }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- BUDGET -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Budget
                        </label>

                        <input type="number"
                               name="budget"
                               value="{{ $project->budget }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

            </div>

            <!-- STATUS -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Status & Priority
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- PRIORITY -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Priority
                        </label>

                        <select name="priority"
                                class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                            <option {{ $project->priority == 'Low' ? 'selected' : '' }}>Low</option>
                            <option {{ $project->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option {{ $project->priority == 'High' ? 'selected' : '' }}>High</option>
                            <option {{ $project->priority == 'Critical' ? 'selected' : '' }}>Critical</option>

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Status
                        </label>

                        <select name="status"
                                class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                            <option {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option {{ $project->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option {{ $project->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                            <option {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>

                        </select>

                    </div>

                    <!-- PROGRESS -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Progress %
                        </label>

                        <input type="number"
                               name="progress"
                               value="{{ $project->progress }}"
                               min="0"
                               max="100"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

            </div>

            <!-- EXTRA -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Extra Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- DEPARTMENT -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Department
                        </label>

                        <input type="text"
                               name="department"
                               value="{{ $project->department }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- TECHNOLOGY -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Technology
                        </label>

                        <input type="text"
                               name="technology"
                               value="{{ $project->technology }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <!-- TEAM SIZE -->
                    <div>

                        <label class="block text-gray-600 font-medium mb-3">
                            Team Size
                        </label>

                        <input type="number"
                               name="team_size"
                               value="{{ $project->team_size }}"
                               class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <div>

                <label class="block text-gray-600 font-medium mb-3">
                    Project Description
                </label>

                <textarea name="description"
                          rows="6"
                          class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none focus:ring-2 focus:ring-blue-500">{{ $project->description }}</textarea>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                Update Project

            </button>

        </form>

    </div>

</div>

@endsection