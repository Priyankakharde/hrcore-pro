@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Edit Payroll
            </h1>

            <p class="text-gray-500 mt-2">
                Update employee salary and payment information
            </p>
        </div>

        <a href="{{ route('payments.index') }}"
           class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl font-semibold">

            Back

        </a>

    </div>

    <!-- ERROR MESSAGE -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 px-6 py-4 rounded-2xl mb-6">

            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <!-- FORM CARD -->
    <div class="bg-white rounded-3xl shadow-sm p-10">

        <form action="{{ route('payments.update', $payment->id) }}"
              method="POST"
              class="space-y-10">

            @csrf
            @method('PUT')

            <!-- EMPLOYEE INFORMATION -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Employee Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-3 font-medium text-gray-700">
                            Employee
                        </label>

                        <select name="employee_id"
                                class="w-full rounded-2xl border-gray-300 px-5 py-4"
                                required>

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}"
                                    {{ $payment->employee_id == $employee->id ? 'selected' : '' }}>

                                    {{ $employee->name }}
                                    ({{ $employee->employee_id }})

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="block mb-3 font-medium text-gray-700">
                            Payroll Month
                        </label>

                        <input type="month"
                               name="month"
                               value="{{ $payment->month }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4"
                               required>

                    </div>

                </div>

            </div>

            <!-- SALARY DETAILS -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
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
                               value="{{ $payment->basic_salary }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4"
                               required>

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Bonus
                        </label>

                        <input type="number"
                               step="0.01"
                               name="bonus"
                               value="{{ $payment->bonus }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Overtime Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               name="overtime_amount"
                               value="{{ $payment->overtime_amount }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Tax
                        </label>

                        <input type="number"
                               step="0.01"
                               name="tax"
                               value="{{ $payment->tax }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Deduction
                        </label>

                        <input type="number"
                               step="0.01"
                               name="deduction"
                               value="{{ $payment->deduction }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                    <div>

                        <label class="block mb-3 font-medium">
                            Net Salary
                        </label>

                        <input type="number"
                               step="0.01"
                               name="net_salary"
                               value="{{ $payment->net_salary }}"
                               readonly
                               class="w-full rounded-2xl border-gray-300 bg-gray-100 px-5 py-4">

                    </div>

                </div>

            </div>

            <!-- PAYMENT DETAILS -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Payment Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    <div>

                        <label class="block mb-3 font-medium">
                            Payment Method
                        </label>

                        <select name="payment_method"
                                class="w-full rounded-2xl border-gray-300 px-5 py-4">

                            <option value="Bank Transfer"
                                {{ $payment->payment_method == 'Bank Transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                            <option value="UPI"
                                {{ $payment->payment_method == 'UPI' ? 'selected' : '' }}>
                                UPI
                            </option>

                            <option value="Cash"
                                {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="Cheque"
                                {{ $payment->payment_method == 'Cheque' ? 'selected' : '' }}>
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

                            <option value="Pending"
                                {{ $payment->payment_status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Paid"
                                {{ $payment->payment_status == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                            <option value="Failed"
                                {{ $payment->payment_status == 'Failed' ? 'selected' : '' }}>
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
                               value="{{ $payment->payment_date }}"
                               class="w-full rounded-2xl border-gray-300 px-5 py-4">

                    </div>

                </div>

            </div>

            <!-- NOTES -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Notes
                </h2>

                <textarea name="notes"
                          rows="5"
                          class="w-full rounded-2xl border-gray-300 px-5 py-4">{{ $payment->notes }}</textarea>

            </div>

            <!-- ACTION BUTTON -->
            <div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg">

                    Update Payroll

                </button>

            </div>

        </form>

    </div>

</div>

@endsection

