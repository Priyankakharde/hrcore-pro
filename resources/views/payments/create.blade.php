@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- PAGE HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Create Payroll
            </h1>

            <p class="text-gray-500 mt-2">
                Generate employee salary payment record
            </p>
        </div>

        <a href="{{ route('payments.index') }}"
           class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl font-semibold">

            Back

        </a>

    </div>

    <!-- FORM CARD -->
    <div class="bg-white rounded-3xl shadow-sm p-10">

        <form action="{{ route('payments.store') }}"
              method="POST"
              class="space-y-10">

            @csrf

            <!-- EMPLOYEE INFORMATION -->
            <div>

                <h2 class="text-2xl font-bold mb-6 text-gray-800">
                    Employee Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- EMPLOYEE -->
                    <div>

                        <label class="block mb-3 font-medium text-gray-700">
                            Employee
                        </label>

                        <select name="employee_id"
                                class="w-full rounded-2xl border-gray-300 px-5 py-4"
                                required>

                            <option value="">
                                Select Employee
                            </option>

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                    ({{ $employee->employee_id }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- MONTH -->
                    <div>

                        <label class="block mb-3 font-medium text-gray-700">
                            Payroll Month
                        </label>

                        <input type="month"
                               name="month"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4"
                               required>

                    </div>

                </div>

            </div>

            <!-- SALARY DETAILS -->
            <div>

                <h2 class="text-2xl font-bold mb-6 text-gray-800">
                    Salary Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    <div>

                        <label class="block mb-3 font-medium">
                            Basic Salary
                        </label>

                        <input type="number"
                               step="0.01"
                               name="basic_salary"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4"
                               required>

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Bonus
                        </label>

                        <input type="number"
                               step="0.01"
                               value="0"
                               name="bonus"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Overtime Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               value="0"
                               name="overtime_amount"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Tax
                        </label>

                        <input type="number"
                               step="0.01"
                               value="0"
                               name="tax"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Deduction
                        </label>

                        <input type="number"
                               step="0.01"
                               value="0"
                               name="deduction"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Net Salary
                        </label>

                        <input type="number"
                               step="0.01"
                               name="net_salary"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                </div>

            </div>

            <!-- PAYMENT INFORMATION -->
            <div>

                <h2 class="text-2xl font-bold mb-6 text-gray-800">
                    Payment Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    <div>

                        <label class="block mb-3 font-medium">
                            Payment Method
                        </label>

                        <select name="payment_method"
                                class="w-full rounded-2xl border-gray-300 px-5 py-4">

                            <option value="Bank Transfer">
                                Bank Transfer
                            </option>

                            <option value="UPI">
                                UPI
                            </option>

                            <option value="Cash">
                                Cash
                            </option>

                            <option value="Cheque">
                                Cheque
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Payment Status
                        </label>

                        <select name="payment_status"
                                class="w-full rounded-2xl border-gray-300 px-5 py-4">

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="Paid">
                                Paid
                            </option>

                            <option value="Failed">
                                Failed
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Payment Date
                        </label>

                        <input type="date"
                               name="payment_date"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                </div>

            </div>

            <!-- NOTES -->
            <div>

                <h2 class="text-2xl font-bold mb-6 text-gray-800">
                    Notes
                </h2>

                <textarea name="notes"
                          rows="5"
                          class="w-full rounded-2xl border-gray-300 px-5 py-4"
                          placeholder="Additional payroll notes..."></textarea>

            </div>

            <!-- BUTTON -->
            <div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg">

                    Create Payroll Record

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
