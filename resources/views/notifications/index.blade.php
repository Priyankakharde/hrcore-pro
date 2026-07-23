@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')


<div class="space-y-8">

    <!-- ================= HEADER ================= -->

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">
                Notification Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage all employee notifications and announcements.
            </p>

        </div>

        <a href="{{ route('notifications.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">

            ➕ Create Notification

        </a>

    </div>

    <!-- ================= DASHBOARD CARDS ================= -->

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

        <!-- Total -->

        <div class="bg-white rounded-2xl shadow-md border-l-4 border-blue-500 p-6">

            <p class="text-gray-500 font-medium">
                Total Notifications
            </p>

            <h2 class="text-4xl font-bold text-blue-600 mt-3">
                {{ $totalNotifications }}
            </h2>

        </div>

        <!-- Unread -->

        <div class="bg-white rounded-2xl shadow-md border-l-4 border-red-500 p-6">

            <p class="text-gray-500 font-medium">
                Unread
            </p>

            <h2 class="text-4xl font-bold text-red-500 mt-3">
                {{ $unreadNotifications }}
            </h2>

        </div>

        <!-- Read -->

        <div class="bg-white rounded-2xl shadow-md border-l-4 border-green-500 p-6">

            <p class="text-gray-500 font-medium">
                Read
            </p>

            <h2 class="text-4xl font-bold text-green-600 mt-3">
                {{ $readNotifications }}
            </h2>

        </div>

        <!-- High Priority -->

        <div class="bg-white rounded-2xl shadow-md border-l-4 border-orange-500 p-6">

            <p class="text-gray-500 font-medium">
                High Priority
            </p>

            <h2 class="text-4xl font-bold text-orange-500 mt-3">
                {{ $highPriority }}
            </h2>

        </div>

        <!-- Today -->

        <div class="bg-white rounded-2xl shadow-md border-l-4 border-purple-500 p-6">

            <p class="text-gray-500 font-medium">
                Today's Notifications
            </p>

            <h2 class="text-4xl font-bold text-purple-600 mt-3">
                {{ $todayNotifications }}
            </h2>

        </div>

    </div>

    <!-- ================= SEARCH ================= -->

    <!-- ================= SEARCH & FILTER ================= -->

<div class="bg-white rounded-2xl shadow-lg p-6">

    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Search Notifications
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Search notifications using keywords and filters.
            </p>
        </div>

    </div>

    <form action="{{ route('notifications.index') }}" method="GET">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

            <!-- Search -->

            <div class="lg:col-span-2">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search title or message..."
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            </div>

            <!-- Type -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Type
                </label>

                <select
                    name="type"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Types</option>

                    <option value="Employee" {{ request('type')=='Employee' ? 'selected' : '' }}>Employee</option>

                    <option value="Leave" {{ request('type')=='Leave' ? 'selected' : '' }}>Leave</option>

                    <option value="Task" {{ request('type')=='Task' ? 'selected' : '' }}>Task</option>

                    <option value="Project" {{ request('type')=='Project' ? 'selected' : '' }}>Project</option>

                    <option value="Payroll" {{ request('type')=='Payroll' ? 'selected' : '' }}>Payroll</option>

                    <option value="Performance" {{ request('type')=='Performance' ? 'selected' : '' }}>Performance</option>

                    <option value="Invoice" {{ request('type')=='Invoice' ? 'selected' : '' }}>Invoice</option>

                    <option value="Event" {{ request('type')=='Event' ? 'selected' : '' }}>Event</option>

                    <option value="Announcement" {{ request('type')=='Announcement' ? 'selected' : '' }}>Announcement</option>

                </select>

            </div>

            <!-- Priority -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Priority
                </label>

                <select
                    name="priority"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Priority</option>

                    <option value="Low" {{ request('priority')=='Low' ? 'selected' : '' }}>Low</option>

                    <option value="Medium" {{ request('priority')=='Medium' ? 'selected' : '' }}>Medium</option>

                    <option value="High" {{ request('priority')=='High' ? 'selected' : '' }}>High</option>

                </select>

            </div>

            <!-- Status -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Status</option>

                    <option value="Unread" {{ request('status')=='Unread' ? 'selected' : '' }}>Unread</option>

                    <option value="Read" {{ request('status')=='Read' ? 'selected' : '' }}>Read</option>

                </select>

            </div>

        </div>

        <div class="flex justify-end gap-3 mt-6">

            <a href="{{ route('notifications.index') }}"
               class="px-6 py-3 rounded-xl border border-gray-300 hover:bg-gray-100 transition">

                Reset

            </a>

            <button
                type="submit"
                class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md transition">

                🔍 Search

            </button>

        </div>

    </form>

</div>

<!-- ================= NOTIFICATION TABLE ================= -->

<div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-8">

    <div class="px-6 py-5 border-b flex items-center justify-between">

        <div>

            <h2 class="text-xl font-bold text-gray-800">
                Notifications
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                All employee notifications.
            </p>

        </div>

        <div class="text-sm text-gray-500">
            Total :
            <span class="font-bold text-blue-600">
                {{ $notifications->count() }}
            </span>
        </div>

    </div>

    <div class="overflow-x-auto w-full">

        <table class="w-full table-auto border-collapse">

            <thead class="bg-gray-100 border-b">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                        Employee
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                        Notification
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                        Type
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                        Priority
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-gray-700 whitespace-nowrap">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse($notifications as $notification)

                <tr class="hover:bg-blue-50 transition">

                    <!-- Employee -->

                    <td class="px-6 py-5">

                        <div class="font-semibold text-gray-800">

                            {{ $notification->user?->name ?? 'No User' }}

                        </div>

                    </td>

                    <!-- Title -->

                    <td class="px-6 py-5">

                        <div class="font-semibold">

                            {{ $notification->title }}

                        </div>

                        <div class="text-sm text-gray-500 mt-1">

                            {{ Str::limit($notification->message,60) }}

                        </div>

                    </td>

                    <!-- Type -->

                    <td class="px-6 py-5">

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

                            {{ $notification->type }}

                        </span>

                    </td>

                    <!-- Priority -->

                    <td class="px-6 py-5">

                        @if($notification->priority=='High')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">

                                High

                            </span>

                        @elseif($notification->priority=='Medium')

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                                Medium

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">

                                Low

                            </span>

                        @endif

                    </td>

                    <!-- Status -->

                    <td class="px-6 py-5">

                        @if($notification->status=='Unread')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">

                                ● Unread

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">

                                ● Read

                            </span>

                        @endif

                    </td>

                    <!-- Buttons -->

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('notifications.show',$notification) }}"
                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                                View

                            </a>

                            <a href="{{ route('notifications.edit',$notification) }}"
                               class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">

                                Edit

                            </a>

                            <form action="{{ route('notifications.destroy',$notification) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete notification?')"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="px-6 py-20 text-center">

                        <div class="text-6xl">

                            🔔

                        </div>

                        <h3 class="text-3xl font-bold text-gray-700 mt-4">

                            No Notifications Found

                        </h3>

                        <p class="text-gray-500 mt-2">

                            Click "Create Notification" to add your first notification.

                        </p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div> 

    <!-- ================= PAGINATION ================= -->

    @if($notifications->hasPages())

    <div class="mt-8 flex justify-center">
        <div class="bg-white rounded-2xl shadow-lg px-6 py-4">
            {{ $notifications->withQueryString()->links() }}
        </div>
    </div>

    @endif

</div>

@endsection