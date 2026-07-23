@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Edit Leave Request
            </h1>

            <p class="text-gray-500 mt-2">
                Update employee leave information
            </p>

        </div>

        <!-- BACK -->
        <a href="{{ route('leaves.index') }}"
           class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl font-semibold">

            Back

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl p-10 shadow-sm">

        <form action="{{ route('leaves.update', ['leave' => $leave->id]) }}"
              method="POST"
              class="space-y-10">

            @csrf
            @method('PUT')

            <!-- EMPLOYEE INFO -->
            <div>

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Employee Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- EMPLOYEE NAME -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Employee Name
                        </label>

                        <input type="text"
                               name="employee_name"
                               value="{{ $leave->employee_name }}"
                               class="w-full rounded-2xl border-gray-200 px-5 py-4"
                               required>

                    </div>

                    <!-- EMPLOYEE ID -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Employee ID
                        </label>

                        <input type="text"
                               name="employee_id"
                               value="{{ $leave->employee_id }}"
                               class="w-full rounded-2xl border-gray-200 px-5 py-4"
                               required>

                    </div>

                </div>

            </div>

            <!-- LEAVE DETAILS -->
            <div>

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Leave Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    <!-- LEAVE TYPE -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Leave Type
                        </label>

                        <select name="leave_type"
                                class="w-full rounded-2xl border-gray-200 px-5 py-4"
                                required>

                            <option value="Sick Leave"
                                {{ $leave->leave_type == 'Sick Leave' ? 'selected' : '' }}>
                                Sick Leave
                            </option>

                            <option value="Casual Leave"
                                {{ $leave->leave_type == 'Casual Leave' ? 'selected' : '' }}>
                                Casual Leave
                            </option>

                            <option value="Emergency Leave"
                                {{ $leave->leave_type == 'Emergency Leave' ? 'selected' : '' }}>
                                Emergency Leave
                            </option>

                            <option value="Maternity Leave"
                                {{ $leave->leave_type == 'Maternity Leave' ? 'selected' : '' }}>
                                Maternity Leave
                            </option>

                            <option value="Vacation Leave"
                                {{ $leave->leave_type == 'Vacation Leave' ? 'selected' : '' }}>
                                Vacation Leave
                            </option>

                        </select>

                    </div>

                    <!-- PRIORITY -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Priority
                        </label>

                        <select name="priority"
                                class="w-full rounded-2xl border-gray-200 px-5 py-4"
                                required>

                            <option value="Low"
                                {{ $leave->priority == 'Low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="Medium"
                                {{ $leave->priority == 'Medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="High"
                                {{ $leave->priority == 'High' ? 'selected' : '' }}>
                                High
                            </option>

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Status
                        </label>

                        <select name="status"
                                class="w-full rounded-2xl border-gray-200 px-5 py-4"
                                required>

                            <option value="Pending"
                                {{ $leave->status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Approved"
                                {{ $leave->status == 'Approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="Rejected"
                                {{ $leave->status == 'Rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                        </select>

                    </div>

                    <!-- START DATE -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Start Date
                        </label>

                        <input type="date"
                               name="start_date"
                               value="{{ \Carbon\Carbon::parse($leave->start_date)->format('Y-m-d') }}"
                               class="w-full rounded-2xl border-gray-200 px-5 py-4"
                               required>

                    </div>

                    <!-- END DATE -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            End Date
                        </label>

                        <input type="date"
                               name="end_date"
                               value="{{ \Carbon\Carbon::parse($leave->end_date)->format('Y-m-d') }}"
                               class="w-full rounded-2xl border-gray-200 px-5 py-4"
                               required>

                    </div>

                    <!-- REMAINING -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Remaining Leave
                        </label>

                        <input type="number"
                               name="remaining_leave"
                               value="{{ $leave->remaining_leave }}"
                               class="w-full rounded-2xl border-gray-200 px-5 py-4">

                    </div>

                </div>

            </div>

            <!-- REASON -->
            <div>

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Leave Reason
                </h2>

                <textarea name="reason"
                          rows="6"
                          class="w-full rounded-2xl border-gray-200 px-5 py-4">{{ $leave->reason }}</textarea>

            </div>

            <!-- ADMIN NOTE -->
            <div>

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Admin Note
                </h2>

                <textarea name="admin_note"
                          rows="4"
                          class="w-full rounded-2xl border-gray-200 px-5 py-4">{{ $leave->admin_note }}</textarea>

            </div>

            <!-- BUTTON -->
            <div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                    Update Leave Request

                </button>

            </div>

        </form>

    </div>

</div>

@endsection