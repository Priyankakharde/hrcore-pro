@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================================= -->
    <!-- PAGE HEADER -->
    <!-- ================================= -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                Edit Invoice

            </h1>

            <p class="text-gray-500 mt-2">

                Update invoice information.

            </p>

        </div>

        <a href="{{ route('invoice.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-xl">

            ← Back

        </a>

    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-300 rounded-xl p-5 mb-6">

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('invoice.update',$invoice) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h2 class="text-2xl font-bold mb-6">

                Invoice Information

            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Employee -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Employee

                    </label>

                    <select
                        name="employee_id"
                        class="w-full border rounded-xl px-4 py-3">

                        @foreach($employees as $employee)

                            <option
                                value="{{ $employee->id }}"
                                {{ old('employee_id',$invoice->employee_id)==$employee->id ? 'selected':'' }}>

                                {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Invoice Date -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Invoice Date

                    </label>

                    <input
                        type="date"
                        name="invoice_date"
                        value="{{ old('invoice_date',$invoice->invoice_date->format('Y-m-d')) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <!-- Due Date -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Due Date

                    </label>

                    <input
                        type="date"
                        name="due_date"
                        value="{{ old('due_date',$invoice->due_date->format('Y-m-d')) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <!-- Subtotal -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Subtotal

                    </label>

                    <input
                        id="subtotal"
                        type="number"
                        step="0.01"
                        name="subtotal"
                        value="{{ old('subtotal',$invoice->subtotal) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <!-- Tax -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Tax

                    </label>

                    <input
                        id="tax"
                        type="number"
                        step="0.01"
                        name="tax"
                        value="{{ old('tax',$invoice->tax) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <!-- Discount -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Discount

                    </label>

                    <input
                        id="discount"
                        type="number"
                        step="0.01"
                        name="discount"
                        value="{{ old('discount',$invoice->discount) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>
                                <!-- Total Amount -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Total Amount

                    </label>

                    <input
                        id="total_amount"
                        type="number"
                        step="0.01"
                        name="total_amount"
                        value="{{ old('total_amount',$invoice->total_amount) }}"
                        readonly
                        class="w-full border rounded-xl px-4 py-3 bg-gray-100">

                </div>

                <!-- Status -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Status

                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="Pending"
                            {{ old('status',$invoice->status)=='Pending' ? 'selected':'' }}>
                            Pending
                        </option>

                        <option value="Paid"
                            {{ old('status',$invoice->status)=='Paid' ? 'selected':'' }}>
                            Paid
                        </option>

                        <option value="Overdue"
                            {{ old('status',$invoice->status)=='Overdue' ? 'selected':'' }}>
                            Overdue
                        </option>

                        <option value="Cancelled"
                            {{ old('status',$invoice->status)=='Cancelled' ? 'selected':'' }}>
                            Cancelled
                        </option>

                    </select>

                </div>

                <!-- Payment Method -->

                <div>

                    <label class="block mb-2 font-semibold">

                        Payment Method

                    </label>

                    <select
                        name="payment_method"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="">Select Method</option>

                        <option value="Cash"
                            {{ old('payment_method',$invoice->payment_method)=='Cash' ? 'selected':'' }}>
                            Cash
                        </option>

                        <option value="UPI"
                            {{ old('payment_method',$invoice->payment_method)=='UPI' ? 'selected':'' }}>
                            UPI
                        </option>

                        <option value="Card"
                            {{ old('payment_method',$invoice->payment_method)=='Card' ? 'selected':'' }}>
                            Card
                        </option>

                        <option value="Cheque"
                            {{ old('payment_method',$invoice->payment_method)=='Cheque' ? 'selected':'' }}>
                            Cheque
                        </option>

                        <option value="Bank Transfer"
                            {{ old('payment_method',$invoice->payment_method)=='Bank Transfer' ? 'selected':'' }}>
                            Bank Transfer
                        </option>

                    </select>

                </div>

                <!-- Notes -->

                <div class="md:col-span-2 lg:col-span-3">

                    <label class="block mb-2 font-semibold">

                        Notes

                    </label>

                    <textarea
                        name="notes"
                        rows="5"
                        class="w-full border rounded-xl px-4 py-3">{{ old('notes',$invoice->notes) }}</textarea>

                </div>

            </div>

            <!-- Buttons -->

            <div class="flex justify-end gap-4 mt-10">

                <a href="{{ route('invoice.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl">

                    Update Invoice

                </button>

            </div>

        </div>

    </form>

</div>

<script>

function calculateTotal() {

    let subtotal = parseFloat(document.getElementById('subtotal').value) || 0;

    let tax = parseFloat(document.getElementById('tax').value) || 0;

    let discount = parseFloat(document.getElementById('discount').value) || 0;

    let total = subtotal + tax - discount;

    document.getElementById('total_amount').value = total.toFixed(2);

}

document.getElementById('subtotal').addEventListener('input', calculateTotal);

document.getElementById('tax').addEventListener('input', calculateTotal);

document.getElementById('discount').addEventListener('input', calculateTotal);

calculateTotal();

</script>

@endsection