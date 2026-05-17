<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ErpSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'ERP Admin',
                'password' => Hash::make('password'),
            ]
        );

        CompanySetting::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'Blue Orange ERP',
                'email' => 'admin@example.com',
                'phone' => '555-123-4567',
                'address' => '100 Business Avenue, Roanoke, VA',
                'tax_number' => 'TAX-123456',
                'currency' => 'USD',
                'default_tax_rate' => 5,
            ]
        );

        $customer1 = Customer::create([
            'name' => 'Acme Corporation',
            'email' => 'billing@acme.test',
            'phone' => '555-111-2222',
            'company' => 'Acme Corporation',
            'billing_address' => '123 Acme Street',
            'shipping_address' => '123 Acme Street',
            'status' => 'active',
        ]);

        $customer2 = Customer::create([
            'name' => 'Blue Ridge Retail',
            'email' => 'orders@blueridge.test',
            'phone' => '555-333-4444',
            'company' => 'Blue Ridge Retail',
            'billing_address' => '456 Ridge Road',
            'shipping_address' => '456 Ridge Road',
            'status' => 'active',
        ]);

        $vendor1 = Vendor::create([
            'name' => 'Orange Supply Co.',
            'contact_person' => 'Olivia Orange',
            'email' => 'sales@orangesupply.test',
            'phone' => '555-555-1000',
            'address' => '900 Supplier Lane',
            'status' => 'active',
        ]);

        $vendor2 = Vendor::create([
            'name' => 'Blue Wholesale',
            'contact_person' => 'Bruce Blue',
            'email' => 'support@bluewholesale.test',
            'phone' => '555-555-2000',
            'address' => '700 Wholesale Blvd',
            'status' => 'active',
        ]);

        $officeCategory = Category::create([
            'name' => 'Office Supplies',
            'description' => 'General office products',
            'status' => 'active',
        ]);

        $techCategory = Category::create([
            'name' => 'Technology',
            'description' => 'Technology equipment and accessories',
            'status' => 'active',
        ]);

        $chair = Product::create([
            'category_id' => $officeCategory->id,
            'vendor_id' => $vendor1->id,
            'name' => 'Ergonomic Office Chair',
            'sku' => 'CHAIR-001',
            'cost_price' => 85.00,
            'selling_price' => 149.99,
            'quantity' => 20,
            'reorder_level' => 5,
            'status' => 'active',
        ]);

        $desk = Product::create([
            'category_id' => $officeCategory->id,
            'vendor_id' => $vendor1->id,
            'name' => 'Standing Desk',
            'sku' => 'DESK-001',
            'cost_price' => 180.00,
            'selling_price' => 299.99,
            'quantity' => 10,
            'reorder_level' => 3,
            'status' => 'active',
        ]);

        $laptop = Product::create([
            'category_id' => $techCategory->id,
            'vendor_id' => $vendor2->id,
            'name' => 'Business Laptop',
            'sku' => 'LAPTOP-001',
            'cost_price' => 650.00,
            'selling_price' => 999.99,
            'quantity' => 4,
            'reorder_level' => 5,
            'status' => 'active',
        ]);

        $salesOrder = SalesOrder::create([
            'customer_id' => $customer1->id,
            'order_number' => 'SO-10001',
            'order_date' => now()->toDateString(),
            'subtotal' => 449.98,
            'tax' => 22.50,
            'discount' => 0,
            'total' => 472.48,
            'status' => 'confirmed',
        ]);

        $salesOrder->items()->create([
            'product_id' => $chair->id,
            'quantity' => 3,
            'unit_price' => 149.99,
            'line_total' => 449.97,
        ]);

        $purchaseOrder = PurchaseOrder::create([
            'vendor_id' => $vendor2->id,
            'purchase_order_number' => 'PO-10001',
            'purchase_order_date' => now()->toDateString(),
            'subtotal' => 1300.00,
            'tax' => 65.00,
            'discount' => 0,
            'total' => 1365.00,
            'status' => 'ordered',
        ]);

        $purchaseOrder->items()->create([
            'product_id' => $laptop->id,
            'quantity' => 2,
            'unit_cost' => 650.00,
            'line_total' => 1300.00,
        ]);

        $invoice = Invoice::create([
            'customer_id' => $customer1->id,
            'sales_order_id' => $salesOrder->id,
            'invoice_number' => 'INV-10001',
            'invoice_date' => now()->toDateString(),
            'due_date' => now()->addDays(30)->toDateString(),
            'subtotal' => 449.97,
            'tax' => 22.50,
            'discount' => 0,
            'total' => 472.47,
            'amount_paid' => 200.00,
            'balance_due' => 272.47,
            'status' => 'sent',
        ]);

        $invoice->items()->create([
            'product_id' => $chair->id,
            'description' => 'Ergonomic Office Chair',
            'quantity' => 3,
            'unit_price' => 149.99,
            'line_total' => 449.97,
        ]);

        Payment::create([
            'invoice_id' => $invoice->id,
            'payment_date' => now()->toDateString(),
            'amount' => 200.00,
            'method' => 'credit_card',
            'reference_number' => 'PAY-10001',
            'notes' => 'Partial payment received.',
        ]);

        Expense::create([
            'vendor_id' => $vendor1->id,
            'title' => 'Office Supplies Restock',
            'category' => 'Office Supplies',
            'expense_date' => now()->toDateString(),
            'amount' => 125.75,
            'payment_method' => 'bank_transfer',
            'notes' => 'Monthly office supplies.',
        ]);
    }
}
