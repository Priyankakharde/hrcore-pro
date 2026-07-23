@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Apply Leave
            </h1>

            <p class="text-gray-500 mt-2">
                Create new employee leave request
            </p>

        </div>

        <a href="{{ route('leaves.index') }}"
           class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl font-semibold">

            Back

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl p-10 shadow-sm">

        <form action="{{ route('leaves.store') }}"
              method="POST"
              class="space-y-10">

            @csrf

            <!-- EMPLOYEE DETAILS -->
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
                               placeholder="Rahul Sharma"
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
                               placeholder="EMP-2026"
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

                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Emergency Leave">Emergency Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Vacation Leave">Vacation Leave</option>

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

                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>

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

                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>

                        </select>

                    </div>

                    <!-- START DATE -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Start Date
                        </label>

                        <input type="date"
                               name="start_date"
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
                               class="w-full rounded-2xl border-gray-200 px-5 py-4"
                               required>

                    </div>

                    <!-- REMAINING LEAVE -->
                    <div>

                        <label class="block text-gray-700 font-medium mb-3">
                            Remaining Leave
                        </label>

                        <input type="number"
                               name="remaining_leave"
                               value="20"
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
                          placeholder="Write leave reason..."
                          class="w-full rounded-2xl border-gray-200 px-5 py-4"></textarea>

            </div>

            <!-- ADMIN NOTE -->
            <div>

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Admin Note
                </h2>

                <textarea name="admin_note"
                          rows="4"
                          placeholder="Write admin note..."
                          class="w-full rounded-2xl border-gray-200 px-5 py-4"></textarea>

            </div>

            <!-- BUTTON -->
            <div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                    Save Leave Request

                </button>

            </div>

        </form>

    </div>

</div>

@endsection