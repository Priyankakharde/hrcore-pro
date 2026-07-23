@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

<div class="space-y-8">

    <!-- ================= HEADER ================= -->

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">
                Chat Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage employee conversations and internal messages.
            </p>

        </div>

        <a href="{{ route('chat.create') }}"
           class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">

            💬 New Chat

        </a>

    </div>


    <!-- ================= CHAT STATISTICS ================= -->

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- Total Chats -->

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border-l-4 border-blue-500 p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-500 font-medium">

                    Total Chats

                </p>

                <h2 class="text-4xl font-bold text-blue-600 mt-3">

                    {{ $totalChats }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-3xl">

                💬

            </div>

        </div>

    </div>

    <!-- Active Chats -->

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border-l-4 border-green-500 p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-500 font-medium">

                    Active Chats

                </p>

                <h2 class="text-4xl font-bold text-green-600 mt-3">

                    {{ $activeChats }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-3xl">

                👥

            </div>

        </div>

    </div>

    <!-- Unread -->

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border-l-4 border-orange-500 p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-500 font-medium">

                    Unread Messages

                </p>

                <h2 class="text-4xl font-bold text-orange-500 mt-3">

                    {{ $unreadChats }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center text-3xl">

                ✉️

            </div>

        </div>

    </div>

    <!-- Today's Chats -->

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border-l-4 border-purple-500 p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-500 font-medium">

                    Today's Chats

                </p>

                <h2 class="text-4xl font-bold text-purple-600 mt-3">

                    {{ $todayChats }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center text-3xl">

                📅

            </div>

        </div>

    </div>

</div>
<!-- ================= SEARCH ================= -->

<div class="bg-white rounded-3xl shadow-lg p-8 mb-10">

    <div class="mb-6">

        <h2 class="text-3xl font-bold text-gray-800">

            Search Chats

        </h2>

        <p class="text-gray-500 mt-2">

            Search chats using keywords and filters.

        </p>

    </div>

    <form action="{{ route('chat.index') }}" method="GET">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Search -->

            <div>

                <label class="block mb-2 font-semibold text-gray-700">

                    Search

                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search employee or message..."
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            </div>

            <!-- Employee -->

            <div>

                <label class="block mb-2 font-semibold text-gray-700">

                    Employee

                </label>

                <select
                    name="employee"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Employees</option>

                    @foreach($employees as $employee)

                        <option
                            value="{{ $employee->id }}"
                            {{ request('employee') == $employee->id ? 'selected' : '' }}>

                            {{ $employee->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- Status -->

            <div>

                <label class="block mb-2 font-semibold text-gray-700">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border-gray-300">

                    <option value="">All Status</option>

                    <option value="Active">Active</option>

                    <option value="Closed">Closed</option>

                </select>

            </div>

            <!-- Read -->

            <div>

                <label class="block mb-2 font-semibold text-gray-700">

                    Read Status

                </label>

                <select
                    name="read"
                    class="w-full rounded-xl border-gray-300">

                    <option value="">All</option>

                    <option value="1">Read</option>

                    <option value="0">Unread</option>

                </select>

            </div>

        </div>

        <div class="flex justify-end gap-4 mt-8">

            <a href="{{ route('chat.index') }}"
               class="px-8 py-3 rounded-xl border border-gray-300 hover:bg-gray-100">

                Reset

            </a>

            <button
                class="px-10 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg">

                🔍 Search

            </button>

        </div>

    </form>

</div>
<!-- ================= CHATS ================= -->

<div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

    <!-- Header -->

    <div class="flex items-center justify-between px-8 py-6 border-b">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">

                Chats

            </h2>

            <p class="text-gray-500 mt-2">

                All employee conversations.

            </p>

        </div>

        <div class="text-lg font-semibold text-gray-500">

            Total :

            <span class="text-blue-600">

                {{ $chats->count() }}

            </span>

        </div>

    </div>

    <!-- Table -->

    <div class="overflow-x-auto w-full">

        <table class="w-full table-auto">

            <thead>

                <tr class="bg-gray-100">

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">

                        Employee

                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">

                        Last Message

                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">

                        Status

                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">

                        Read

                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">

                        Updated

                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-gray-700 whitespace-nowrap">

                        Actions

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($chats as $chat)
                <tr class="border-b hover:bg-gray-50 transition">

    <!-- Employee -->

    <td class="px-6 py-5">

        <div class="flex items-center gap-4">

            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-xl">

                👤

            </div>

            <div>

                <h4 class="font-semibold text-gray-800">

                    {{ $chat->employee->name ?? 'N/A' }}

                </h4>

                <p class="text-sm text-gray-500">

                    ID : {{ $chat->employee->id ?? '-' }}

                </p>

            </div>

        </div>

    </td>

    <!-- Last Message -->

    <td class="px-6 py-5 max-w-sm">

        <div class="font-semibold text-gray-800">

            {{ $chat->subject }}

        </div>

        <div class="text-sm text-gray-500 mt-1">

            {{ \Illuminate\Support\Str::limit($chat->message,60) }}

        </div>

    </td>

    <!-- Status -->

    <td class="px-6 py-5">

        @if($chat->status=='Active')

            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                Active

            </span>

        @else

            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold">

                Closed

            </span>

        @endif

    </td>

    <!-- Read -->

    <td class="px-6 py-5">

        @if($chat->is_read)

            <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

                Read

            </span>

        @else

            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">

                Unread

            </span>

        @endif

    </td>

    <!-- Updated -->

    <td class="px-6 py-5 text-gray-600">

        {{ $chat->updated_at->diffForHumans() }}

    </td>

    <!-- Actions -->

    <td class="px-6 py-5">

        <div class="flex justify-center gap-2">
            <!-- View -->

<a href="{{ route('chat.show', $chat) }}"
   class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition"
   title="View">

    👁

</a>

<!-- Edit -->

<a href="{{ route('chat.edit', $chat) }}"
   class="w-10 h-10 flex items-center justify-center rounded-xl bg-yellow-100 text-yellow-600 hover:bg-yellow-500 hover:text-white transition"
   title="Edit">

    ✏️

</a>

<!-- Delete -->

<form
    action="{{ route('chat.destroy', $chat) }}"
    method="POST"
    onsubmit="return confirm('Are you sure you want to delete this chat?')">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition"
        title="Delete">

        🗑️

    </button>

</form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="6" class="p-0">

        <div class="flex flex-col items-center justify-center min-h-[420px] bg-gradient-to-b from-white to-blue-50">

            <div class="w-32 h-32 rounded-full bg-blue-100 shadow-lg flex items-center justify-center text-7xl mb-8">

                💬

            </div>

            <h2 class="text-4xl font-bold text-gray-800 mt-2">

                No Chats Found

            </h2>

            <p class="mt-3 text-lg text-gray-500">

                There are no conversations available.

            </p>

            <p class="text-gray-400 mt-2 mb-8">

                Click the <strong>New Chat</strong> button above to create one.

            </p>

        </div>

    </td>

</tr>

@endforelse
            </tbody>

        </table>

    </div>

</div>
<!-- ================= PAGINATION ================= -->

@if($chats->hasPages())

<div class="mt-10 flex flex-col md:flex-row justify-between items-center gap-4">

    <div class="text-gray-600 font-medium">

        Showing

        <span class="font-bold">

            {{ $chats->firstItem() }}

        </span>

        to

        <span class="font-bold">

            {{ $chats->lastItem() }}

        </span>

        of

        <span class="font-bold">

            {{ $chats->total() }}

        </span>

        chats

    </div>

    <div class="bg-white rounded-2xl shadow-lg px-6 py-4">

        {{ $chats->withQueryString()->links() }}

    </div>

</div>

@endif

@endsection