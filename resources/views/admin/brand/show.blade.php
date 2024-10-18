@extends('layouts.admin.admin-layout')

@section('content')
<div class="container mt-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-3">
            <img src="{{ $brand->logo }}" alt="{{ $brand->name_en }}" class="img-fluid rounded-circle brand-logo shadow">
        </div>
        <div class="col-md-9">
            <h1 class="display-4">{{ $brand->name_en }} <small class="text-muted">({{ $brand->name_ar }})</small></h1>
            <p class="lead">Explore the products from {{ $brand->name_en }}</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="border-bottom pb-2">Products ({{ $brand->products->count() }})</h2>
        </div>
    </div>

    <div class="row">
        @forelse($brand->products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name_en }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name_en }}</h5>
                        <p class="card-text">{{ Str::limit($product->description_en, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">API: {{ $product->API }}</small>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No products found for this brand.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        <nav aria-label="Page navigation">
            {{ $products->links() }}
        </nav>
    </div>
</div>
@endsection

@push('styles')
<style>
    .brand-logo {
        max-width: 200px;
        border: 5px solid #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>
@endpush