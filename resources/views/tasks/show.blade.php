@extends('layouts.app')

@section('content')

<div class="p-8 bg-[#f5f7fb] min-h-screen">

    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-sm p-10">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-10">

            <div>
                <h1 class="text-5xl font-bold text-gray-800">
                    Task Details
                </h1>

                <p class="text-gray-400 mt-2">
                    Complete task information
                </p>
            </div>

            <a href="{{ route('tasks.index') }}"
               class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl transition">

                Back
            </a>

        </div>

        <!-- TASK CARD -->
        <div class="bg-[#f5f7fb] rounded-3xl p-8 border border-gray-100">

            <!-- TITLE -->
            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-4xl font-bold text-gray-800">
                        {{ $task->title }}
                    </h2>

                    <p class="text-gray-400 mt-2">
                        Assigned to {{ $task->employee }}
                    </p>

                </div>

                <!-- PRIORITY -->
                <span class="px-5 py-2 rounded-full text-sm font-semibold

                    {{ $task->priority == 'High' ? 'bg-red-100 text-red-500' : '' }}

                    {{ $task->priority == 'Medium' ? 'bg-yellow-100 text-yellow-600' : '' }}

                    {{ $task->priority == 'Low' ? 'bg-green-100 text-green-600' : '' }}
                ">

                    {{ $task->priority }}

                </span>

            </div>

            <!-- DESCRIPTION -->
            <div class="mb-10">

                <h3 class="text-xl font-semibold text-gray-700 mb-3">
                    Description
                </h3>

                <p class="text-gray-500 leading-8">
                    {{ $task->description }}
                </p>

            </div>

            <!-- DETAILS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- STATUS -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100">

                    <p class="text-gray-400 text-sm mb-2">
                        Task Status
                    </p>

                    <h3 class="text-2xl font-bold text-blue-600">
                        {{ $task->status }}
                    </h3>

                </div>

                <!-- DUE DATE -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100">

                    <p class="text-gray-400 text-sm mb-2">
                        Due Date
                    </p>

                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ $task->due_date }}
                    </h3>

                </div>

                <!-- CREATED -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100">

                    <p class="text-gray-400 text-sm mb-2">
                        Created At
                    </p>

                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ $task->created_at->format('d M Y') }}
                    </h3>

                </div>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex items-center gap-4 mt-10">

                <a href="{{ route('tasks.edit', $task->id) }}"
                   class="bg-purple-100 text-purple-600 px-6 py-3 rounded-2xl font-medium">

                    Edit Task
                </a>

                <form action="{{ route('tasks.destroy', $task->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="bg-red-100 text-red-500 px-6 py-3 rounded-2xl font-medium">
                        Delete Task
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection