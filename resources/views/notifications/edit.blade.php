@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">

                Edit Notification

            </h1>

            <p class="text-gray-500 mt-2">

                Update notification details.

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
        action="{{ route('notifications.update',$notification) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Employee -->

                <div>

                    <label class="block font-semibold mb-2">

                        Employee

                    </label>

                    <select
                        name="user_id"
                        class="w-full border rounded-xl px-4 py-3">

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id',$notification->user_id)==$user->id ? 'selected':'' }}>

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
                        value="{{ old('title',$notification->title) }}"
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
                        class="w-full border rounded-xl px-4 py-3">{{ old('message',$notification->message) }}</textarea>

                </div>

                <!-- Type -->

                <div>

                    <label class="block font-semibold mb-2">

                        Notification Type

                    </label>

                    <select
                        name="type"
                        class="w-full border rounded-xl px-4 py-3">

                        @foreach(['Employee','Leave','Task','Project','Payroll','Performance','Invoice','Event','Announcement'] as $type)

                            <option value="{{ $type }}"
                                {{ old('type',$notification->type)==$type ? 'selected':'' }}>

                                {{ $type }}

                            </option>

                        @endforeach

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

                        @foreach(['Low','Medium','High'] as $priority)

                            <option value="{{ $priority }}"
                                {{ old('priority',$notification->priority)==$priority ? 'selected':'' }}>

                                {{ $priority }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Status -->

                <div>

                    <label class="block font-semibold mb-2">

                        Status

                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="Unread"
                            {{ old('status',$notification->status)=='Unread' ? 'selected' : '' }}>

                            Unread

                        </option>

                        <option value="Read"
                            {{ old('status',$notification->status)=='Read' ? 'selected' : '' }}>

                            Read

                        </option>

                    </select>

                </div>

                <!-- Action URL -->

                <div>

                    <label class="block font-semibold mb-2">

                        Action URL

                    </label>

                    <input
                        type="text"
                        name="action_url"
                        value="{{ old('action_url',$notification->action_url) }}"
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

                    Update Notification

                </button>

            </div>

        </div>

    </form>

</div>

@endsection