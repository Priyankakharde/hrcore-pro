<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Employee;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display Invoice Dashboard
     */
    public function index(Request $request)
    {
        $query = Invoice::with('employee');

        // Search Employee
        if ($request->filled('search')) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            });

        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // Filter Payment Method
        if ($request->filled('payment_method')) {

            $query->where('payment_method', $request->payment_method);

        }

        $invoices = $query
            ->latest()
            ->paginate(10);

        // Dashboard Cards

        $totalInvoices = Invoice::count();

        $paidInvoices = Invoice::where('status', 'Paid')->count();

        $pendingInvoices = Invoice::where('status', 'Pending')->count();

        $overdueInvoices = Invoice::where('status', 'Overdue')->count();

        $totalRevenue = Invoice::where('status', 'Paid')
            ->sum('total_amount');

        return view('invoice.index', compact(

            'invoices',

            'totalInvoices',

            'paidInvoices',

            'pendingInvoices',

            'overdueInvoices',

            'totalRevenue'

        ));
    }

    /**
     * Show Create Form
     */

    public function create()
    {
        $employees = Employee::orderBy('name')->get();

        return view('invoice.create', compact('employees'));
    }

    /**
     * Store Invoice
     */

    public function store(Request $request)
    {
                $validated = $request->validate([

            'employee_id' => 'required|exists:employees,id',

            'invoice_date' => 'required|date',

            'due_date' => 'required|date|after_or_equal:invoice_date',

            'subtotal' => 'required|numeric|min:0',

            'tax' => 'required|numeric|min:0',

            'discount' => 'required|numeric|min:0',

            'status' => 'required',

            'payment_method' => 'nullable',

            'notes' => 'nullable',

        ]);

        // Auto Generate Invoice Number

        $validated['invoice_number'] = 'INV-' . date('Ymd') . '-' . str_pad(
            Invoice::count() + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        // Calculate Total

        $validated['total_amount'] =
            $validated['subtotal']
            + $validated['tax']
            - $validated['discount'];

        Invoice::create($validated);

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice created successfully.');

    }

    /**
     * Display Invoice
     */

    public function show(Invoice $invoice)
    {
        $invoice->load('employee');

        return view('invoice.show', compact('invoice'));
    }

    /**
     * Edit Invoice
     */

    public function edit(Invoice $invoice)
    {
        $employees = Employee::orderBy('name')->get();

        return view(
            'invoice.edit',
            compact('invoice', 'employees')
        );
    }

    /**
     * Update Invoice
     */

    public function update(Request $request, Invoice $invoice)
    {
                $validated = $request->validate([

            'employee_id' => 'required|exists:employees,id',

            'invoice_date' => 'required|date',

            'due_date' => 'required|date|after_or_equal:invoice_date',

            'subtotal' => 'required|numeric|min:0',

            'tax' => 'required|numeric|min:0',

            'discount' => 'required|numeric|min:0',

            'status' => 'required',

            'payment_method' => 'nullable',

            'notes' => 'nullable',

        ]);

        // Calculate Total Amount

        $validated['total_amount'] =
            $validated['subtotal']
            + $validated['tax']
            - $validated['discount'];

        $invoice->update($validated);

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice updated successfully.');

    }

    /**
     * Delete Invoice
     */

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice deleted successfully.');
    }
}