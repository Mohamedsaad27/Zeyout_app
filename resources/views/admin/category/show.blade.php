@extends('layouts.admin.admin-layout')
@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Category Details</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name_en }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit Category</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Category Information</h4>
        <div class="row mt-4">
            <div class="col-md-6">
                <p><strong>Name (English):</strong> {{ $category->name_en }}</p>
                <p><strong>Name (Arabic):</strong> {{ $category->name_ar }}</p>
                <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</p>
                <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}</p>
            </div>
            <div class="col-md-6">
                @if($category->logo)
                    <img src="{{ $category->logo }}" alt="{{ $category->name_en }} Logo" class="img-fluid" style="max-width: 200px;">
                @else
                    <p>No logo available</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">Associated Products</h4>
        @if($category->products->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name (English)</th>
                        <th>Product Name (Arabic)</th>
                        <th>Product Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products as $product)
                        <tr>
                            <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name_en }}</a></td>
                            <td>{{ $product->name_ar }}</td>
                            <td>{{ $product->product_variants->first()->unit_price ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No products associated with this category.</p>
        @endif
    </div>
</div>
@endsection