<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\SalesOrder;
use App\Models\PurchaseOrder;
use App\Models\Expense;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalCustomers' => Customer::count(),
            'totalVendors' => Vendor::count(),
            'totalProducts' => Product::count(),
            'lowStockProducts' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),

            'totalSales' => SalesOrder::sum('total'),
            'totalPurchases' => PurchaseOrder::sum('total'),
            'totalInvoices' => Invoice::count(),
            'unpaidInvoices' => Invoice::whereIn('status', ['draft', 'sent', 'overdue'])->count(),

            'totalPayments' => Payment::sum('amount'),
            'totalExpenses' => Expense::sum('amount'),

            'recentInvoices' => Invoice::with('customer')->latest()->take(5)->get(),
            'recentProducts' => Product::with(['category', 'vendor'])->latest()->take(5)->get(),
        ]);
    }
}
