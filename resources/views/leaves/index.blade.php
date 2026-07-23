@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Leave Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage employee leave requests and approvals
            </p>

        </div>

        <a href="{{ route('leaves.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition">

            + Apply Leave

        </a>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-gray-400">
                Total Leaves
            </p>

            <h2 class="text-5xl font-bold mt-4">
                {{ $totalLeaves }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-yellow-500">
                Pending
            </p>

            <h2 class="text-5xl font-bold mt-4 text-yellow-500">
                {{ $pendingLeaves }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-green-500">
                Approved
            </p>

            <h2 class="text-5xl font-bold mt-4 text-green-500">
                {{ $approvedLeaves }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-red-500">
                Rejected
            </p>

            <h2 class="text-5xl font-bold mt-4 text-red-500">
                {{ $rejectedLeaves }}
            </h2>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <form method="GET"
              action="{{ route('leaves.index') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-5">

            <!-- SEARCH -->
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search employee..."
                   class="rounded-2xl border-gray-200 px-5 py-4">

            <!-- STATUS -->
            <select name="status"
                    class="rounded-2xl border-gray-200 px-5 py-4">

                <option value="">All Status</option>

                <option value="Pending"
                    {{ request('status') == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Approved"
                    {{ request('status') == 'Approved' ? 'selected' : '' }}>
                    Approved
                </option>

                <option value="Rejected"
                    {{ request('status') == 'Rejected' ? 'selected' : '' }}>
                    Rejected
                </option>

            </select>

            <!-- PRIORITY -->
            <select name="priority"
                    class="rounded-2xl border-gray-200 px-5 py-4">

                <option value="">All Priority</option>

                <option value="Low"
                    {{ request('priority') == 'Low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="Medium"
                    {{ request('priority') == 'Medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="High"
                    {{ request('priority') == 'High' ? 'selected' : '' }}>
                    High
                </option>

            </select>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-semibold px-6 py-4">

                Filter Leaves

            </button>

        </form>

    </div>

    <!-- LEAVES -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        @forelse($leaves as $leave)

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

            <!-- TOP -->
            <div class="flex justify-between items-start">

                <div>

                    <div class="flex gap-3 items-center mb-4">

                        <!-- TYPE -->
                        <span class="px-4 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-600">

                            {{ $leave->leave_type }}

                        </span>

                        <!-- PRIORITY -->
                        @if($leave->priority == 'High')

                            <span class="px-4 py-1 rounded-full text-sm font-medium bg-red-100 text-red-600">

                                High

                            </span>

                        @elseif($leave->priority == 'Medium')

                            <span class="px-4 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-600">

                                Medium

                            </span>

                        @else

                            <span class="px-4 py-1 rounded-full text-sm font-medium bg-green-100 text-green-600">

                                Low

                            </span>

                        @endif

                    </div>

                    <!-- EMPLOYEE -->
                    <h2 class="text-3xl font-bold text-gray-800">

                        {{ $leave->employee_name }}

                    </h2>

                    <p class="text-gray-400 mt-1">

                        Employee ID: {{ $leave->employee_id }}

                    </p>

                </div>

                <!-- STATUS -->
                @if($leave->status == 'Approved')

                    <span class="px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-600">

                        Approved

                    </span>

                @elseif($leave->status == 'Rejected')

                    <span class="px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-600">

                        Rejected

                    </span>

                @else

                    <span class="px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-600">

                        Pending

                    </span>

                @endif

            </div>

            <!-- DETAILS -->
            <div class="mt-6 space-y-3 text-gray-600">

                <p>
                    📅 {{ $leave->start_date }} → {{ $leave->end_date }}
                </p>

                <p>
                    🕒 Total Days: {{ $leave->total_days }}
                </p>

                <p>
                    🎯 Remaining Leave: {{ $leave->remaining_leave }}
                </p>

                <p>
                    📌 Applied: {{ $leave->applied_date }}
                </p>

            </div>

            <!-- REASON -->
            <div class="mt-6">

                <p class="text-gray-700 leading-relaxed">

                    {{ $leave->reason }}

                </p>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex flex-wrap gap-4 mt-8">

                <!-- VIEW -->
                <a href="{{ route('leaves.show', $leave->id) }}"
                   class="px-5 py-3 rounded-xl bg-blue-100 text-blue-600 font-medium">

                    View

                </a>

                <!-- EDIT -->
                <a href="{{ route('leaves.edit', $leave->id) }}"
                   class="px-5 py-3 rounded-xl bg-purple-100 text-purple-600 font-medium">

                    Edit

                </a>

                <!-- APPROVE -->
                <form action="{{ route('leaves.approve', $leave->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <button class="px-5 py-3 rounded-xl bg-green-100 text-green-600 font-medium">

                        Approve

                    </button>

                </form>

                <!-- REJECT -->
                <form action="{{ route('leaves.reject', $leave->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <button class="px-5 py-3 rounded-xl bg-yellow-100 text-yellow-700 font-medium">

                        Reject

                    </button>

                </form>

                <!-- DELETE -->
                <form action="{{ route('leaves.destroy', $leave->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="px-5 py-3 rounded-xl bg-red-100 text-red-600 font-medium">

                        Delete

                    </button>

                </form>

            </div>

        </div>

        @empty

        <div class="bg-white rounded-3xl p-20 text-center col-span-2">

            <h2 class="text-4xl font-bold text-gray-700">

                No Leave Requests Found

            </h2>

            <p class="text-gray-400 mt-4">

                Create your first leave request

            </p>

        </div>

        @endforelse

    </div>

</div>

@endsection