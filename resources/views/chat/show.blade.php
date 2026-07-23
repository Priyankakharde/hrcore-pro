@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- ================= HEADER ================= -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">

                Chat Details

            </h1>

            <p class="text-gray-500 mt-2">

                View complete conversation details.

            </p>

        </div>

        <a href="{{ route('chat.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl shadow">

            ← Back

        </a>

    </div>

    <!-- ================= CHAT CARD ================= -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Employee -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Employee

                </h3>

                <p class="text-xl font-semibold mt-2">

                    {{ $chat->employee->name }}

                </p>

            </div>

            <!-- Subject -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Subject

                </h3>

                <p class="text-xl font-semibold mt-2">

                    {{ $chat->subject }}

                </p>

            </div>

            <!-- Status -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Status

                </h3>

                <div class="mt-2">

                    @if($chat->status=='Active')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            Active

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            Closed

                        </span>

                    @endif

                </div>

            </div>

            <!-- Priority -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Priority

                </h3>

                <div class="mt-2">

                    @if($chat->priority=='High')

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            High

                        </span>

                    @elseif($chat->priority=='Medium')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            Medium

                        </span>

                    @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            Low

                        </span>

                    @endif

                </div>

            </div>
                        <!-- Read Status -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Read Status

                </h3>

                <div class="mt-2">

                    @if($chat->is_read)

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

                            Read

                        </span>

                    @else

                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full">

                            Unread

                        </span>

                    @endif

                </div>

            </div>

            <!-- Chat Type -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Chat Type

                </h3>

                <p class="text-xl font-semibold mt-2">

                    {{ $chat->chat_type }}

                </p>

            </div>

            <!-- Pinned -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Pinned

                </h3>

                <div class="mt-2">

                    @if($chat->is_pinned)

                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full">

                            📌 Yes

                        </span>

                    @else

                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">

                            No

                        </span>

                    @endif

                </div>

            </div>

            <!-- Important -->

            <div>

                <h3 class="text-sm text-gray-500">

                    Important

                </h3>

                <div class="mt-2">

                    @if($chat->is_starred)

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            ⭐ Yes

                        </span>

                    @else

                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">

                            No

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <!-- ================= MESSAGE ================= -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">

            Message

        </h2>

        <div class="bg-gray-50 rounded-xl p-6 leading-8 text-gray-700">

            {{ $chat->message }}

        </div>

    </div>

        <!-- ================= ATTACHMENT ================= -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">

            Attachment

        </h2>

        @if($chat->attachment)

            <a href="{{ asset('storage/'.$chat->attachment) }}"
               target="_blank"
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow">

                📎 View Attachment

            </a>

        @else

            <div class="text-gray-500">

                No attachment uploaded.

            </div>

        @endif

    </div>

    <!-- ================= INFORMATION ================= -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">

            Chat Information

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>

                <h3 class="text-sm text-gray-500">

                    Created At

                </h3>

                <p class="text-lg font-semibold mt-2">

                    {{ $chat->created_at->format('d M Y, h:i A') }}

                </p>

            </div>

            <div>

                <h3 class="text-sm text-gray-500">

                    Last Updated

                </h3>

                <p class="text-lg font-semibold mt-2">

                    {{ $chat->updated_at->format('d M Y, h:i A') }}

                </p>

            </div>

        </div>

    </div>

    <!-- ================= ACTION BUTTONS ================= -->

    <div class="flex justify-end gap-4">

        <a href="{{ route('chat.edit', $chat) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl shadow">

            ✏ Edit Chat

        </a>

        <form
            action="{{ route('chat.destroy', $chat) }}"
            method="POST">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Delete this chat?')"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow">

                🗑 Delete

            </button>

        </form>

    </div>

</div>

@endsection