@extends('layouts.app')

@section('content')

<div class="p-8 bg-[#f5f7fb] min-h-screen">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Task Board
            </h1>

            <p class="text-gray-400 mt-2">
                Manage all company tasks from one place
            </p>
        </div>

        <a href="{{ route('tasks.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition">

            + Create Task
        </a>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <p class="text-gray-400">Total Tasks</p>
            <h2 class="text-4xl font-bold mt-3">
                {{ $tasks->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <p class="text-gray-400">To Do</p>
            <h2 class="text-4xl font-bold mt-3 text-red-500">
                {{ $tasks->where('status','To Do')->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <p class="text-gray-400">In Progress</p>
            <h2 class="text-4xl font-bold mt-3 text-yellow-500">
                {{ $tasks->where('status','In Progress')->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <p class="text-gray-400">Completed</p>
            <h2 class="text-4xl font-bold mt-3 text-green-500">
                {{ $tasks->where('status','Completed')->count() }}
            </h2>
        </div>

    </div>

    <!-- KANBAN BOARD -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- TODO -->
        <div class="bg-white rounded-3xl p-5 shadow-sm">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-red-500">
                    To Do
                </h2>

                <span class="bg-red-100 text-red-500 px-3 py-1 rounded-full text-sm">
                    {{ $tasks->where('status','To Do')->count() }}
                </span>
            </div>

            <div class="space-y-5">

                @foreach($tasks->where('status','To Do') as $task)

                <div class="bg-[#f5f7fb] rounded-2xl p-5 border border-gray-100">

                    <div class="flex items-start justify-between">

                        <h3 class="font-bold text-lg text-gray-800">
                            {{ $task->title }}
                        </h3>

                        <span class="text-xs px-3 py-1 rounded-full
                            {{ $task->priority == 'High' ? 'bg-red-100 text-red-500' : '' }}
                            {{ $task->priority == 'Medium' ? 'bg-yellow-100 text-yellow-600' : '' }}
                            {{ $task->priority == 'Low' ? 'bg-green-100 text-green-600' : '' }}">
                            {{ $task->priority }}
                        </span>

                    </div>

                    <p class="text-gray-400 mt-3 text-sm">
                        {{ $task->description }}
                    </p>

                    <div class="mt-5 space-y-2">

                        <p class="text-sm text-gray-500">
                            👤 {{ $task->employee }}
                        </p>

                        <p class="text-sm text-gray-500">
                            📅 {{ $task->due_date }}
                        </p>

                    </div>

                    <div class="flex items-center gap-3 mt-5">

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="bg-purple-100 text-purple-600 px-4 py-2 rounded-xl text-sm">

                            Edit
                        </a>

                        <form action="{{ route('tasks.destroy', $task->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-100 text-red-500 px-4 py-2 rounded-xl text-sm">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- IN PROGRESS -->
        <div class="bg-white rounded-3xl p-5 shadow-sm">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-yellow-500">
                    In Progress
                </h2>

                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm">
                    {{ $tasks->where('status','In Progress')->count() }}
                </span>
            </div>

            <div class="space-y-5">

                @foreach($tasks->where('status','In Progress') as $task)

                <div class="bg-[#f5f7fb] rounded-2xl p-5 border border-gray-100">

                    <div class="flex items-start justify-between">

                        <h3 class="font-bold text-lg text-gray-800">
                            {{ $task->title }}
                        </h3>

                        <span class="text-xs px-3 py-1 rounded-full
                            {{ $task->priority == 'High' ? 'bg-red-100 text-red-500' : '' }}
                            {{ $task->priority == 'Medium' ? 'bg-yellow-100 text-yellow-600' : '' }}
                            {{ $task->priority == 'Low' ? 'bg-green-100 text-green-600' : '' }}">
                            {{ $task->priority }}
                        </span>

                    </div>

                    <p class="text-gray-400 mt-3 text-sm">
                        {{ $task->description }}
                    </p>

                    <div class="mt-5 space-y-2">

                        <p class="text-sm text-gray-500">
                            👤 {{ $task->employee }}
                        </p>

                        <p class="text-sm text-gray-500">
                            📅 {{ $task->due_date }}
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- REVIEW -->
        <div class="bg-white rounded-3xl p-5 shadow-sm">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-blue-500">
                    Review
                </h2>

                <span class="bg-blue-100 text-blue-500 px-3 py-1 rounded-full text-sm">
                    {{ $tasks->where('status','Review')->count() }}
                </span>
            </div>

            <div class="space-y-5">

                @foreach($tasks->where('status','Review') as $task)

                <div class="bg-[#f5f7fb] rounded-2xl p-5 border border-gray-100">

                    <h3 class="font-bold text-lg text-gray-800">
                        {{ $task->title }}
                    </h3>

                    <p class="text-gray-400 mt-3 text-sm">
                        {{ $task->description }}
                    </p>

                    <div class="mt-5">

                        <p class="text-sm text-gray-500">
                            👤 {{ $task->employee }}
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- COMPLETED -->
        <div class="bg-white rounded-3xl p-5 shadow-sm">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-green-500">
                    Completed
                </h2>

                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                    {{ $tasks->where('status','Completed')->count() }}
                </span>
            </div>

            <div class="space-y-5">

                @foreach($tasks->where('status','Completed') as $task)

                <div class="bg-[#f5f7fb] rounded-2xl p-5 border border-gray-100">

                    <h3 class="font-bold text-lg text-gray-800">
                        {{ $task->title }}
                    </h3>

                    <p class="text-gray-400 mt-3 text-sm">
                        {{ $task->description }}
                    </p>

                    <div class="mt-5">

                        <p class="text-sm text-gray-500">
                            👤 {{ $task->employee }}
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection