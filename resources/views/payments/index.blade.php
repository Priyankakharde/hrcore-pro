@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row justify-between items-center mb-10 gap-4">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Payroll Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage employee salaries, payroll records, bonuses, deductions and payments
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('payments.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg">

                + Add Salary

            </a>

        </div>

    </div>

    <!-- DASHBOARD STATS -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-500">
                Total Payroll
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                ₹{{ number_format($totalPayroll ?? 0,2) }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-500">
                Paid Payroll
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                ₹{{ number_format($paidPayroll ?? 0,2) }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-500">
                Pending Payroll
            </p>

            <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                ₹{{ number_format($pendingPayroll ?? 0,2) }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-500">
                Total Records
            </p>

            <h2 class="text-3xl font-bold text-purple-600 mt-2">
                {{ $salaries->count() }}
            </h2>

        </div>

    </div>

    <!-- SEARCH + FILTER -->

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8">

        <form method="GET">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search employee..."
                    class="rounded-2xl border-gray-300 px-4 py-3 w-full">

                <select
                    name="status"
                    class="rounded-2xl border-gray-300 px-4 py-3">

                    <option value="">
                        All Status
                    </option>

                    <option value="Paid"
                        {{ request('status')=='Paid' ? 'selected' : '' }}>
                        Paid
                    </option>

                    <option value="Pending"
                        {{ request('status')=='Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Failed"
                        {{ request('status')=='Failed' ? 'selected' : '' }}>
                        Failed
                    </option>

                </select>

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl px-5 py-3">

                    Search

                </button>

            </div>

        </form>

    </div>

    <!-- PAYROLL TABLE -->

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="text-2xl font-bold text-gray-800">
                Employee Payroll Records
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left">Employee</th>
                    <th class="px-6 py-4 text-left">Month</th>
                    <th class="px-6 py-4 text-left">Basic Salary</th>
                    <th class="px-6 py-4 text-left">Bonus</th>
                    <th class="px-6 py-4 text-left">Deduction</th>
                    <th class="px-6 py-4 text-left">Net Salary</th>
                    <th class="px-6 py-4 text-left">Payment Date</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Actions</th>

                </tr>

                </thead>

                <tbody>

                @forelse($salaries as $salary)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-6 py-4">

                            <div>

                                <div class="font-semibold text-gray-800">
                                    {{ $salary->employee->name ?? 'N/A' }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $salary->employee->department ?? '' }}
                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-4">
                            {{ $salary->month }}
                        </td>

                        <td class="px-6 py-4">
                            ₹{{ number_format($salary->basic_salary,2) }}
                        </td>

                        <td class="px-6 py-4 text-green-600 font-semibold">
                            ₹{{ number_format($salary->bonus,2) }}
                        </td>

                        <td class="px-6 py-4 text-red-600 font-semibold">
                            ₹{{ number_format($salary->deduction,2) }}
                        </td>

                        <td class="px-6 py-4 text-blue-600 font-bold">
                            ₹{{ number_format($salary->net_salary,2) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $salary->payment_date ?? '-' }}
                        </td>

                        <td class="px-6 py-4">

                            @if($salary->payment_status == 'Paid')

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    Paid
                                </span>

                            @elseif($salary->payment_status == 'Pending')

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    Pending
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    Failed
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex gap-2 flex-wrap">

                                <a href="{{ route('payments.show',$salary->id) }}"
                                   class="bg-blue-100 text-blue-600 px-3 py-2 rounded-xl">
                                    View
                                </a>

                                <a href="{{ route('payments.edit',$salary->id) }}"
                                   class="bg-purple-100 text-purple-600 px-3 py-2 rounded-xl">
                                    Edit
                                </a>

                                <form action="{{ route('payments.destroy',$salary->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete Payroll Record?')"
                                        class="bg-red-100 text-red-600 px-3 py-2 rounded-xl">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9"
                            class="text-center py-12 text-gray-500">

                            No payroll records found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-6">

            {{ $salaries->links() }}

        </div>

    </div>

</div>

@endsection

