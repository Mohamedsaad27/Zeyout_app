@extends('layouts.admin.admin-layout')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Products</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Brand</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Breadcrumb --}}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Create New Brand</h4>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                        <input type="text" placeholder="Name (Arabic)" class="form-control" id="name_ar" name="name_ar" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="name_en" class="form-label">Name (English)</label>
                        <input type="text" placeholder="Name (English)" class="form-control" id="name_en" name="name_en" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <input type="text" placeholder="Description (Arabic)" class="form-control" id="description_ar" name="description_ar" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="description_en" class="form-label">Description (English)</label>
                        <input type="text" placeholder="Description (English)" class="form-control" id="description_en" name="description_en" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="categories" class="form-label fw-semibold">Categories</label>
                        <select class="form-select" id="categories" name="categories[]" multiple required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="text-capitalize">{{ $category->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-select" id="brand_id" name="brand_id" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name_ar }}</option>
                            @endforeach
                        </select>
                        <label for="api" class="form-label">API</label>
                        <input type="number" placeholder="API" class="form-control" id="api" name="api" required>
                        
                    </div>
                    <div class="mb-3 col-6">
                        <label for="product_variants" class="form-label">Product Details</label>
                        <div id="product_variants">
                            <div class="product-variant">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="size" class="form-label w-100 ">Size</label>
                                        <input type="text" placeholder="Size" class="form-control" id="size" name="product_variants[0][size]" required>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="mileage" class="form-label">Mileage</label>
                                        <input type="text" placeholder="Mileage" class="form-control" id="mileage" name="product_variants[0][mileage]" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="wholesale_price" class="form-label">Wholesale Price</label>
                                        <input type="number" placeholder="Wholesale Price" class="form-control" id="wholesale_price" name="product_variants[0][wholesale_price]" required>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="unit_price" class="form-label">Unit Price</label>
                                        <input type="number" placeholder="Unit Price" class="form-control" id="unit_price" name="product_variants[0][unit_price]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Product</button>
            </form>
        </div>
    </div>
    </div>
@endsection

