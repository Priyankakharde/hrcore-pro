@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Payroll Details
            </h1>

            <p class="text-gray-500 mt-2">
                Complete employee salary and payment information
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('payments.edit', $payment->id) }}"
               class="bg-purple-100 hover:bg-purple-200 text-purple-700 px-6 py-3 rounded-2xl font-semibold">

                Edit Payroll

            </a>

            <a href="{{ route('payments.index') }}"
               class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl font-semibold">

                Back

            </a>

        </div>

    </div>

    <!-- EMPLOYEE CARD -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <div class="flex flex-col lg:flex-row justify-between gap-10">

            <div>

                <h2 class="text-4xl font-bold text-gray-800">

                    {{ $payment->employee->name ?? 'Employee' }}

                </h2>

                <p class="text-gray-500 mt-2">

                    Employee ID :
                    {{ $payment->employee->employee_id ?? '-' }}

                </p>

                <p class="text-gray-500 mt-2">

                    Department :
                    {{ $payment->employee->department ?? '-' }}

                </p>

                <p class="text-gray-500 mt-2">

                    Designation :
                    {{ $payment->employee->designation ?? '-' }}

                </p>

            </div>

            <div>

                @if($payment->payment_status == 'Paid')

                    <span class="px-6 py-3 rounded-full bg-green-100 text-green-700 font-semibold">
                        Paid
                    </span>

                @elseif($payment->payment_status == 'Pending')

                    <span class="px-6 py-3 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                        Pending
                    </span>

                @else

                    <span class="px-6 py-3 rounded-full bg-red-100 text-red-700 font-semibold">
                        Failed
                    </span>

                @endif

            </div>

        </div>

    </div>

    <!-- PAYROLL SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-blue-50 rounded-3xl p-6">

            <p class="text-blue-500 mb-2">
                Basic Salary
            </p>

            <h3 class="text-3xl font-bold text-blue-700">
                ₹{{ number_format($payment->basic_salary, 2) }}
            </h3>

        </div>

        <div class="bg-green-50 rounded-3xl p-6">

            <p class="text-green-500 mb-2">
                Bonus
            </p>

            <h3 class="text-3xl font-bold text-green-700">
                ₹{{ number_format($payment->bonus ?? 0, 2) }}
            </h3>

        </div>

        <div class="bg-purple-50 rounded-3xl p-6">

            <p class="text-purple-500 mb-2">
                Overtime
            </p>

            <h3 class="text-3xl font-bold text-purple-700">
                ₹{{ number_format($payment->overtime_amount ?? 0, 2) }}
            </h3>

        </div>

        <div class="bg-red-50 rounded-3xl p-6">

            <p class="text-red-500 mb-2">
                Net Salary
            </p>

            <h3 class="text-3xl font-bold text-red-700">
                ₹{{ number_format($payment->net_salary, 2) }}
            </h3>

        </div>

    </div>

    <!-- PAYROLL BREAKDOWN -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <h2 class="text-3xl font-bold text-gray-800 mb-8">
            Payroll Breakdown
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Tax
                </p>

                <h3 class="text-2xl font-bold">
                    ₹{{ number_format($payment->tax ?? 0, 2) }}
                </h3>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Deduction
                </p>

                <h3 class="text-2xl font-bold">
                    ₹{{ number_format($payment->deduction ?? 0, 2) }}
                </h3>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Payroll Month
                </p>

                <h3 class="text-2xl font-bold">
                    {{ $payment->month }}
                </h3>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Payment Date
                </p>

                <h3 class="text-2xl font-bold">
                    {{ $payment->payment_date ?? 'Not Paid Yet' }}
                </h3>

            </div>

        </div>

    </div>

    <!-- PAYMENT INFORMATION -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Payment Information
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <p class="text-gray-500 mb-2">
                    Payment Method
                </p>

                <h3 class="text-xl font-bold">
                    {{ $payment->payment_method ?? 'N/A' }}
                </h3>

            </div>

            <div>

                <p class="text-gray-500 mb-2">
                    Status
                </p>

                <h3 class="text-xl font-bold">
                    {{ $payment->payment_status }}
                </h3>

            </div>

        </div>

    </div>

    <!-- NOTES -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Notes
        </h2>

        <div class="bg-gray-50 rounded-2xl p-6">

            <p class="text-gray-700 leading-relaxed">

                {{ $payment->notes ?? 'No notes available.' }}

            </p>

        </div>

    </div>

</div>

@endsection
