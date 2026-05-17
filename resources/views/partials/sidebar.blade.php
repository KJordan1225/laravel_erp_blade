<aside class="erp-sidebar" id="erpSidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-grid-1x2-fill"></i>
        </div>
        <div>
            <div class="brand-title">Blue Orange ERP</div>
            <div class="brand-subtitle">Business Management</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('customers.index') }}" class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Customers</span>
        </a>

        <a href="{{ route('vendors.index') }}" class="sidebar-link {{ request()->routeIs('vendors.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i>
            <span>Vendors</span>
        </a>

        <a href="{{ route('categories.index') }}" class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            <span>Categories</span>
        </a>

        <a href="{{ route('products.index') }}" class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Products</span>
        </a>

        <a href="{{ route('inventory.index') }}" class="sidebar-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-data"></i>
            <span>Inventory</span>
        </a>

        <a href="{{ route('sales-orders.index') }}" class="sidebar-link {{ request()->routeIs('sales-orders.*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i>
            <span>Sales Orders</span>
        </a>

        <a href="{{ route('purchase-orders.index') }}" class="sidebar-link {{ request()->routeIs('purchase-orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i>
            <span>Purchase Orders</span>
        </a>

        <a href="{{ route('invoices.index') }}" class="sidebar-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>Invoices</span>
        </a>

      {{--  <a href="{{ route('payments.index') }}" class="sidebar-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card"></i>
            <span>Payments</span>
        </a>

        <a href="{{ route('expenses.index') }}" class="sidebar-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i>
            <span>Expenses</span>
        </a>

        <a href="{{ route('reports.index') }}" class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i>
            <span>Reports</span>
        </a>

        <a href="{{ route('company-settings.index') }}" class="sidebar-link {{ request()->routeIs('company-settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span>Company Settings</span>
        </a> --}}
    </nav>
</aside>
