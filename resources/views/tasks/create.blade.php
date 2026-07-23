@extends('layouts.app')

@section('content')

<div class="p-8 bg-[#f5f7fb] min-h-screen">

    <div class="max-w-5xl mx-auto bg-white rounded-3xl p-10 shadow-sm">

        <div class="flex items-center justify-between mb-10">

            <div>
                <h1 class="text-5xl font-bold">
                    Create Task
                </h1>

                <p class="text-gray-400 mt-2">
                    Add new company task
                </p>
            </div>

            <a href="{{ route('tasks.index') }}"
               class="bg-gray-100 px-6 py-3 rounded-2xl">
                Back
            </a>

        </div>

        <form action="{{ route('tasks.store') }}"
              method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <input type="text"
                       name="title"
                       placeholder="Task Title"
                       class="border border-gray-200 rounded-2xl px-5 py-4">

                <input type="text"
                       name="employee"
                       placeholder="Assigned Employee"
                       class="border border-gray-200 rounded-2xl px-5 py-4">

                <select name="priority"
                        class="border border-gray-200 rounded-2xl px-5 py-4">

                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>

                </select>

                <select name="status"
                        class="border border-gray-200 rounded-2xl px-5 py-4">

                    <option>To Do</option>
                    <option>In Progress</option>
                    <option>Review</option>
                    <option>Completed</option>

                </select>

                <input type="date"
                       name="due_date"
                       class="border border-gray-200 rounded-2xl px-5 py-4">

                <textarea name="description"
                          rows="5"
                          placeholder="Task Description"
                          class="md:col-span-2 border border-gray-200 rounded-2xl px-5 py-4"></textarea>

            </div>

            <button class="mt-8 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl">
                Save Task
            </button>

        </form>

    </div>

</div>

@endsection