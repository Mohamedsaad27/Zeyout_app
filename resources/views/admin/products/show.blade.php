@extends('layouts.admin.admin-layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image }}" alt="{{ $product->name_en }}" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
            <h1 class="mb-4">{{ $product->name_en }} <small class="text-muted">({{ $product->name_ar }})</small></h1>
            <p class="lead">{{ $product->description_en }}</p>
            <p class="text-muted">{{ $product->description_ar }}</p>
            
            <div class="mb-4">
                <h4>Brand</h4>
                <p><img src="{{ $product->brand->logo }}" alt="{{ $product->brand->name_en }}" class="img-thumbnail" style="width: 50px; height: 50px;"> {{ $product->brand->name_en }}</p>
            </div>
            
            <div class="mb-4">
                <h4>Categories</h4>
                <div>
                    @foreach($product->categories as $category)
                        <span class="badge bg-primary me-2">{{ $category->name_en }}</span>
                    @endforeach
                </div>
            </div>
            
            <div class="mb-4">
                <h4>API</h4>
                <p>{{ $product->API }}</p>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <h2 class="mb-4">Product Variants</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Size</th>
                        <th>Mileage</th>
                        <th>Wholesale Price</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->product_variants as $variant)
                    <tr>
                        <td>{{ $variant->size }}</td>
                        <td>{{ $variant->mileage }}</td>
                        <td>${{ number_format($variant->wholesale_price, 2) }}</td>
                        <td>${{ number_format($variant->unit_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-5">
        <h2 class="mb-4">Related Products</h2>
        <div class="row">
            @foreach($product->relatedProducts as $relatedProduct)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $relatedProduct->image }}" class="card-img-top" alt="{{ $relatedProduct->name_en }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $relatedProduct->name_en }}</h5>
                        <p class="card-text">{{ Str::limit($relatedProduct->description_en, 100) }}</p>
                        <a href="{{ route('products.show', $relatedProduct->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .img-thumbnail {
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 100%;
        height: auto;
    }
    .badge {
        font-size: 0.9em;
    }
    .table-responsive {
        border-radius: .25rem;
        overflow: hidden;
    }
</style>
@endpush