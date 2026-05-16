@extends('layouts.app')

@section('title', 'Categories - Blue Orange ERP')
@section('page_title', 'Categories')
@section('page_subtitle', 'Manage product categories')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Category List</h5>

        <a href="{{ route('categories.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Category
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="fw-bold">{{ $category->name }}</td>
                        <td>{{ $category->description ?? 'N/A' }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <span class="status-badge status-{{ $category->status }}">
                                {{ $category->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="delete-form">
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
                        <td colspan="5" class="text-center text-muted py-4">
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $categories->links() }}
    </div>
</div>
@endsection
