@extends('layouts.app')

@section('title', 'Customers - Blue Orange ERP')
@section('page_title', 'Customers')
@section('page_subtitle', 'Manage customer records')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Customer List</h5>

        <a href="{{ route('customers.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Customer
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td class="fw-bold">{{ $customer->name }}</td>
                        <td>{{ $customer->company ?? 'N/A' }}</td>
                        <td>{{ $customer->email ?? 'N/A' }}</td>
                        <td>{{ $customer->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="status-badge status-{{ $customer->status }}">
                                {{ $customer->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No customers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $customers->links() }}
    </div>
</div>
@endsection
