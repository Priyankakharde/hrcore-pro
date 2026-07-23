@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================= HEADER ================= -->

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">

                Edit Chat

            </h1>

            <p class="text-gray-500 mt-2">

                Update conversation details.

            </p>

        </div>

        <a href="{{ route('chat.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl shadow">

            ← Back to Chats

        </a>

    </div>

    <!-- ================= ERRORS ================= -->

    @if($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-5 mb-8">

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- ================= FORM ================= -->

    <form
        action="{{ route('chat.update', $chat) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- ================= EMPLOYEE ================= -->

<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Employee

    </label>

    <select
        name="employee_id"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        @foreach($employees as $employee)

            <option
                value="{{ $employee->id }}"
                {{ old('employee_id', $chat->employee_id) == $employee->id ? 'selected' : '' }}>

                {{ $employee->name }}

            </option>

        @endforeach

    </select>

</div>

<!-- ================= STATUS ================= -->

<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Chat Status

    </label>

    <select
        name="status"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        <option value="Active"
            {{ old('status', $chat->status) == 'Active' ? 'selected' : '' }}>

            Active

        </option>

        <option value="Closed"
            {{ old('status', $chat->status) == 'Closed' ? 'selected' : '' }}>

            Closed

        </option>

    </select>

</div>

<!-- ================= PRIORITY ================= -->

<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Priority

    </label>

    <select
        name="priority"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        <option value="Low"
            {{ old('priority', $chat->priority) == 'Low' ? 'selected' : '' }}>

            Low

        </option>

        <option value="Medium"
            {{ old('priority', $chat->priority) == 'Medium' ? 'selected' : '' }}>

            Medium

        </option>

        <option value="High"
            {{ old('priority', $chat->priority) == 'High' ? 'selected' : '' }}>

            High

        </option>

    </select>

</div>

<!-- ================= READ STATUS ================= -->

<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Read Status

    </label>

    <select
        name="is_read"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        <option value="0"
            {{ old('is_read', $chat->is_read) == 0 ? 'selected' : '' }}>

            Unread

        </option>

        <option value="1"
            {{ old('is_read', $chat->is_read) == 1 ? 'selected' : '' }}>

            Read

        </option>

    </select>

</div>

<!-- ================= SUBJECT ================= -->

<div class="md:col-span-2">

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Subject

    </label>

    <input
        type="text"
        name="subject"
        value="{{ old('subject', $chat->subject) }}"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

</div>

<!-- ================= MESSAGE ================= -->

<div class="md:col-span-2">

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Message

    </label>

    <textarea
        name="message"
        rows="8"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('message', $chat->message) }}</textarea>

</div>

<!-- ================= ATTACHMENT ================= -->

<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Upload New Attachment

    </label>

    <input
        type="file"
        name="attachment"
        class="w-full rounded-xl border border-gray-300 p-3">

    @if($chat->attachment)

        <div class="mt-3">

            <a href="{{ asset('storage/'.$chat->attachment) }}"
               target="_blank"
               class="text-blue-600 hover:underline">

                📎 Current Attachment

            </a>

        </div>

    @endif

</div>

<!-- ================= CHAT TYPE ================= -->

<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">

        Chat Type

    </label>

    <select
        name="chat_type"
        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        <option value="Private"
            {{ old('chat_type', $chat->chat_type) == 'Private' ? 'selected' : '' }}>

            Private

        </option>

        <option value="Group"
            {{ old('chat_type', $chat->chat_type) == 'Group' ? 'selected' : '' }}>

            Group

        </option>

    </select>

</div>

<!-- ================= PIN CHAT ================= -->

<div>

    <label class="flex items-center gap-3 mt-8">

        <input
            type="checkbox"
            name="is_pinned"
            value="1"
            {{ old('is_pinned', $chat->is_pinned) ? 'checked' : '' }}
            class="rounded border-gray-300 text-blue-600">

        <span class="text-gray-700 font-medium">

            Pin this conversation

        </span>

    </label>

</div>

<!-- ================= STAR CHAT ================= -->

<div>

    <label class="flex items-center gap-3 mt-8">

        <input
            type="checkbox"
            name="is_starred"
            value="1"
            {{ old('is_starred', $chat->is_starred) ? 'checked' : '' }}
            class="rounded border-gray-300 text-yellow-500">

        <span class="text-gray-700 font-medium">

            Mark as Important

        </span>

    </label>

</div>

            </div>

            <!-- ================= ACTION BUTTONS ================= -->

            <div class="border-t mt-10 pt-8">

                <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                    <!-- Left Side -->

                    <div class="flex gap-3">

                        <button
                            type="button"
                            class="px-5 py-3 rounded-xl bg-yellow-100 hover:bg-yellow-200 text-yellow-700 font-semibold transition">

                            😊 Emoji

                        </button>

                        <button
                            type="button"
                            class="px-5 py-3 rounded-xl bg-purple-100 hover:bg-purple-200 text-purple-700 font-semibold transition">

                            📎 Attachment

                        </button>

                    </div>

                    <!-- Right Side -->

                    <div class="flex gap-3">

                        <a href="{{ route('chat.index') }}"
                           class="px-6 py-3 rounded-xl bg-gray-500 hover:bg-gray-600 text-white font-semibold shadow">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg transition">

                            💾 Update Chat

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection