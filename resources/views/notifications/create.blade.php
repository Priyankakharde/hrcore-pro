@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">

                Create Notification

            </h1>

            <p class="text-gray-500 mt-2">

                Send a new notification to an employee.

            </p>

        </div>

        <a href="{{ route('notifications.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl">

            ← Back

        </a>

    </div>

    @if($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-4 mb-6">

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('notifications.store') }}"
        method="POST">

        @csrf

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- User -->

                <div>

                    <label class="block font-semibold mb-2">

                        Employee

                    </label>

                    <select
                        name="user_id"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="">

                            Select Employee

                        </option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id')==$user->id ? 'selected':'' }}>

                                {{ $user->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Title -->

                <div>

                    <label class="block font-semibold mb-2">

                        Notification Title

                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>
                                <!-- Message -->

                <div class="md:col-span-2">

                    <label class="block font-semibold mb-2">

                        Message

                    </label>

                    <textarea
                        name="message"
                        rows="5"
                        class="w-full border rounded-xl px-4 py-3">{{ old('message') }}</textarea>

                </div>

                <!-- Type -->

                <div>

                    <label class="block font-semibold mb-2">

                        Notification Type

                    </label>

                    <select
                        name="type"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="">Select Type</option>

                        <option value="Employee">Employee</option>
                        <option value="Leave">Leave</option>
                        <option value="Task">Task</option>
                        <option value="Project">Project</option>
                        <option value="Payroll">Payroll</option>
                        <option value="Performance">Performance</option>
                        <option value="Invoice">Invoice</option>
                        <option value="Event">Event</option>
                        <option value="Announcement">Announcement</option>

                    </select>

                </div>

                <!-- Priority -->

                <div>

                    <label class="block font-semibold mb-2">

                        Priority

                    </label>

                    <select
                        name="priority"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="Low">Low</option>
                        <option value="Medium" selected>Medium</option>
                        <option value="High">High</option>

                    </select>

                </div>

                <!-- Action URL -->

                <div class="md:col-span-2">

                    <label class="block font-semibold mb-2">

                        Action URL (Optional)

                    </label>

                    <input
                        type="text"
                        name="action_url"
                        value="{{ old('action_url') }}"
                        placeholder="/employees/1"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

            </div>

            <!-- Buttons -->

            <div class="flex justify-end gap-4 mt-8">

                <a href="{{ route('notifications.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl">

                    Create Notification

                </button>

            </div>

        </div>

    </form>

</div>

@endsection