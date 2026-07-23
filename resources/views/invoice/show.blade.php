@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================================= -->
    <!-- PAGE HEADER -->
    <!-- ================================= -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                Invoice Details

            </h1>

            <p class="text-gray-500 mt-2">

                View complete invoice information.

            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('invoice.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-xl">

                ← Back

            </a>

            <a href="{{ route('invoice.edit',$invoice) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

                Edit

            </a>

        </div>

    </div>

    <!-- ================================= -->
    <!-- INVOICE INFORMATION -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8 mb-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>

                <h2 class="text-2xl font-bold text-blue-600">

                    {{ $invoice->invoice_number }}

                </h2>

                <p class="text-gray-500 mt-2">

                    Employee :
                    <strong>{{ $invoice->employee->name }}</strong>

                </p>

                <p class="text-gray-500">

                    Payment Method :
                    <strong>{{ $invoice->payment_method ?? '-' }}</strong>

                </p>

            </div>

            <div class="text-right">

                <p>

                    <strong>Invoice Date:</strong>

                    {{ $invoice->invoice_date->format('d M Y') }}

                </p>

                <p class="mt-2">

                    <strong>Due Date:</strong>

                    {{ $invoice->due_date->format('d M Y') }}

                </p>

                <p class="mt-2">

                    <strong>Status:</strong>

                    @if($invoice->status=='Paid')

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                            Paid

                        </span>

                    @elseif($invoice->status=='Pending')

                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">

                            Pending

                        </span>

                    @elseif($invoice->status=='Overdue')

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">

                            Overdue

                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700">

                            Cancelled

                        </span>

                    @endif

                </p>

            </div>

        </div>

    </div>

    <!-- ================================= -->
    <!-- BILL SUMMARY -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8">

        <h2 class="text-2xl font-bold mb-8">

            Billing Summary

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Subtotal -->

            <div class="flex justify-between border-b py-4">

                <span class="font-semibold">

                    Subtotal

                </span>

                <span>

                    ₹{{ number_format($invoice->subtotal,2) }}

                </span>

            </div>

            <!-- Tax -->

            <div class="flex justify-between border-b py-4">

                <span class="font-semibold">

                    Tax

                </span>

                <span>

                    ₹{{ number_format($invoice->tax,2) }}

                </span>

            </div>

            <!-- Discount -->

            <div class="flex justify-between border-b py-4">

                <span class="font-semibold">

                    Discount

                </span>

                <span>

                    ₹{{ number_format($invoice->discount,2) }}

                </span>

            </div>

            <!-- Total Amount -->

            <div class="flex justify-between py-6">

                <span class="text-2xl font-bold">

                    Total Amount

                </span>

                <span class="text-2xl font-bold text-blue-600">

                    ₹{{ number_format($invoice->total_amount,2) }}

                </span>

            </div>

        </div>

    </div>

    <!-- ================================= -->
    <!-- NOTES -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8 mt-8">

        <h2 class="text-2xl font-bold mb-5">

            Notes

        </h2>

        <p class="text-gray-700 whitespace-pre-line">

            {{ $invoice->notes ?? 'No notes available.' }}

        </p>

    </div>

    <!-- ================================= -->
    <!-- SUMMARY CARDS -->
    <!-- ================================= -->

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Invoice Number

            </p>

            <h2 class="text-2xl font-bold mt-3">

                {{ $invoice->invoice_number }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Payment Method

            </p>

            <h2 class="text-2xl font-bold mt-3">

                {{ $invoice->payment_method ?? '-' }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Status

            </p>

            <h2 class="text-2xl font-bold mt-3">

                {{ $invoice->status }}

            </h2>

        </div>

    </div>
        <!-- ================================= -->
    <!-- ACTION BUTTONS -->
    <!-- ================================= -->

    <div class="flex flex-wrap justify-end gap-4 mt-8">

        <!-- Print -->

        <button
            onclick="window.print()"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

            🖨 Print Invoice

        </button>

        <!-- PDF -->

        <a href="#"
           class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">

            📄 Download PDF

        </a>

        <!-- Edit -->

        <a href="{{ route('invoice.edit', $invoice) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

            ✏ Edit Invoice

        </a>

        <!-- Delete -->

        <form
            action="{{ route('invoice.destroy', $invoice) }}"
            method="POST">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Are you sure you want to delete this invoice?')"
                class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-xl">

                🗑 Delete Invoice

            </button>

        </form>

    </div>

</div>

@endsection