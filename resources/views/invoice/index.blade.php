@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================================= -->
    <!-- PAGE HEADER -->
    <!-- ================================= -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                Invoice Management

            </h1>

            <p class="text-gray-500 mt-2">

                Manage employee invoices, payments and billing.

            </p>

        </div>

        <div class="flex gap-3">

            <a href="#"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                Export Excel

            </a>

            <a href="#"
               class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

                Export PDF

            </a>

            <button onclick="window.print()"
                    class="bg-gray-700 hover:bg-gray-800 text-white px-5 py-3 rounded-xl shadow">

                Print Report

            </button>

            <a href="{{ route('invoice.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                + Create Invoice

            </a>

        </div>

    </div>

    <!-- ================================= -->
    <!-- DASHBOARD CARDS -->
    <!-- ================================= -->

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Total Invoices

            </p>

            <h2 class="text-4xl font-bold text-blue-600 mt-3">

                {{ $totalInvoices }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Paid

            </p>

            <h2 class="text-4xl font-bold text-green-600 mt-3">

                {{ $paidInvoices }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Pending

            </p>

            <h2 class="text-4xl font-bold text-yellow-500 mt-3">

                {{ $pendingInvoices }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Overdue

            </p>

            <h2 class="text-4xl font-bold text-red-600 mt-3">

                {{ $overdueInvoices }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500">

                Revenue

            </p>

            <h2 class="text-3xl font-bold text-indigo-600 mt-3">

                ₹{{ number_format($totalRevenue,2) }}

            </h2>

        </div>

    </div>

    <!-- ================================= -->
    <!-- SEARCH & FILTER -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">

        <form
            action="{{ route('invoice.index') }}"
            method="GET">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Employee..."
                    class="border rounded-xl px-4 py-3">

                <select
                    name="status"
                    class="border rounded-xl px-4 py-3">

                    <option value="">All Status</option>

                    <option value="Paid"
                        {{ request('status')=='Paid' ? 'selected':'' }}>

                        Paid

                    </option>

                    <option value="Pending"
                        {{ request('status')=='Pending' ? 'selected':'' }}>

                        Pending

                    </option>

                    <option value="Overdue"
                        {{ request('status')=='Overdue' ? 'selected':'' }}>

                        Overdue

                    </option>

                    <option value="Cancelled"
                        {{ request('status')=='Cancelled' ? 'selected':'' }}>

                        Cancelled

                    </option>

                </select>

                <select
                    name="payment_method"
                    class="border rounded-xl px-4 py-3">

                    <option value="">Payment Method</option>

                    <option value="Cash">Cash</option>

                    <option value="UPI">UPI</option>

                    <option value="Card">Card</option>

                    <option value="Cheque">Cheque</option>

                    <option value="Bank Transfer">Bank Transfer</option>

                </select>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl">

                    Search

                </button>

            </div>

        </form>

    </div>

    <!-- ================================= -->
    <!-- INVOICE TABLE -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">
                                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Invoice No.</th>

                        <th class="px-6 py-4 text-left">Employee</th>

                        <th class="px-6 py-4 text-left">Invoice Date</th>

                        <th class="px-6 py-4 text-left">Due Date</th>

                        <th class="px-6 py-4 text-left">Payment Method</th>

                        <th class="px-6 py-4 text-left">Status</th>

                        <th class="px-6 py-4 text-right">Amount</th>

                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($invoices as $invoice)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4 font-semibold">

                                {{ $invoice->invoice_number }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $invoice->employee->name }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $invoice->invoice_date->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $invoice->due_date->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $invoice->payment_method ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                @if($invoice->status=='Paid')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                        Paid

                                    </span>

                                @elseif($invoice->status=='Pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                                        Pending

                                    </span>

                                @elseif($invoice->status=='Overdue')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">

                                        Overdue

                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm">

                                        Cancelled

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-right font-bold">

                                ₹{{ number_format($invoice->total_amount,2) }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('invoice.show',$invoice) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

                                        View

                                    </a>

                                    <a href="{{ route('invoice.edit',$invoice) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('invoice.destroy',$invoice) }}"
                                        method="POST">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this invoice?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-10 text-gray-500">

                                No invoices found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
                <!-- Pagination -->

        <div class="px-6 py-5 border-t">

            {{ $invoices->links() }}

        </div>

    </div>

    <!-- ================================= -->
    <!-- REVENUE CHART -->
    <!-- ================================= -->

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        <!-- Revenue Overview -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h2 class="text-xl font-bold text-gray-700 mb-6">

                Monthly Revenue

            </h2>

            <div id="revenueChart"></div>

        </div>

        <!-- Invoice Status -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h2 class="text-xl font-bold text-gray-700 mb-6">

                Invoice Status

            </h2>

            <div id="statusChart"></div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    var revenueChart = new ApexCharts(
        document.querySelector("#revenueChart"),
        {

            chart: {
                type: 'bar',
                height: 320
            },

            series: [{
                name: 'Revenue',
                data: [12000,18000,15000,22000,28000,25000,30000]
            }],

            xaxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul'
                ]
            }

        });

    revenueChart.render();

    var statusChart = new ApexCharts(
        document.querySelector("#statusChart"),
        {

            chart: {
                type: 'donut',
                height: 320
            },

            series: [
                {{ $paidInvoices }},
                {{ $pendingInvoices }},
                {{ $overdueInvoices }}
            ],

            labels: [
                'Paid',
                'Pending',
                'Overdue'
            ]

        });

    statusChart.render();

});

</script>

@endsection