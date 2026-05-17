<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index', [
            'totalSales' => SalesOrder::sum('total'),
            'totalPurchases' => PurchaseOrder::sum('total'),
            'totalInvoices' => Invoice::sum('total'),
            'totalPayments' => Payment::sum('amount'),
            'totalExpenses' => Expense::sum('amount'),
            'accountsReceivable' => Invoice::sum('balance_due'),

            'customerCount' => Customer::count(),
            'productCount' => Product::count(),
            'lowStockCount' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),

            'recentInvoices' => Invoice::with('customer')->latest()->take(10)->get(),
            'lowStockProducts' => Product::whereColumn('quantity', '<=', 'reorder_level')
                ->orderBy('quantity')
                ->take(10)
                ->get(),
        ]);
    }
}
