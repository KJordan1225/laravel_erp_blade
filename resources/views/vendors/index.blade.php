@extends('layouts.app')

@section('title', 'Vendors - Blue Orange ERP')
@section('page_title', 'Vendors')
@section('page_subtitle', 'Manage vendors and suppliers')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Vendor List</h5>

        <a href="{{ route('vendors.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Vendor
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($vendors as $vendor)
                    <tr>
                        <td class="fw-bold">{{ $vendor->name }}</td>
                        <td>{{ $vendor->contact_person ?? 'N/A' }}</td>
                        <td>{{ $vendor->email ?? 'N/A' }}</td>
                        <td>{{ $vendor->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="status-badge status-{{ $vendor->status }}">
                                {{ $vendor->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('vendors.show', $vendor) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('vendors.destroy', $vendor) }}" class="delete-form">
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
                            No vendors found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $vendors->links() }}
    </div>
</div>
@endsection
