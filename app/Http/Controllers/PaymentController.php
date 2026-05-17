<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice.customer')
            ->latest()
            ->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $invoices = Invoice::with('customer')
            ->where('status', '!=', 'paid')
            ->orderByDesc('id')
            ->get();

        $selectedInvoice = $request->invoice_id;

        return view('payments.create', compact('invoices', 'selectedInvoice'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'invoice_id' => ['required', 'exists:invoices,id'],
            'payment_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'method' => ['required', 'in:cash,check,credit_card,bank_transfer,other'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data) {
            $payment = Payment::create($data);

            $invoice = $payment->invoice;
            $amountPaid = $invoice->payments()->sum('amount');
            $balanceDue = max($invoice->total - $amountPaid, 0);

            $invoice->update([
                'amount_paid' => $amountPaid,
                'balance_due' => $balanceDue,
                'status' => $balanceDue <= 0 ? 'paid' : 'sent',
            ]);
        });

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('invoice.customer');

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $invoices = Invoice::with('customer')
            ->orderByDesc('id')
            ->get();

        return view('payments.edit', compact('payment', 'invoices'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'invoice_id' => ['required', 'exists:invoices,id'],
            'payment_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'method' => ['required', 'in:cash,check,credit_card,bank_transfer,other'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($payment, $data) {
            $oldInvoice = $payment->invoice;

            $payment->update($data);

            $this->refreshInvoiceTotals($oldInvoice);
            $this->refreshInvoiceTotals($payment->fresh()->invoice);
        });

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        DB::transaction(function () use ($payment) {
            $invoice = $payment->invoice;

            $payment->delete();

            $this->refreshInvoiceTotals($invoice);
        });

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    private function refreshInvoiceTotals(Invoice $invoice): void
    {
        $amountPaid = $invoice->payments()->sum('amount');
        $balanceDue = max($invoice->total - $amountPaid, 0);

        $invoice->update([
            'amount_paid' => $amountPaid,
            'balance_due' => $balanceDue,
            'status' => $balanceDue <= 0 ? 'paid' : 'sent',
        ]);
    }
}
