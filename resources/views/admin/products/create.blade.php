@extends('layouts.admin.admin-layout')
@section('content')
@push('scripts')
    <script>
        document.getElementById('add-variant').addEventListener('click', function() {
            fetch('/add-variant', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ variants_count: document.querySelectorAll('.product-variant').length })
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('product_variants').insertAdjacentHTML('beforeend', html);
            })
            .catch(error => {
                console.error('Error adding variant:', error);
            });
        });
    </script>
@endpush
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Products</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted"
                                    href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Breadcrumb --}}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Create New Product</h4>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                        <input type="text" placeholder="Name (Arabic)"
                            class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar"
                            value="{{ old('name_ar') }}">
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="name_en" class="form-label">Name (English)</label>
                        <input type="text" placeholder="Name (English)"
                            class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en"
                            value="{{ old('name_en') }}">
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <input type="text" placeholder="Description (Arabic)"
                            class="form-control @error('description_ar') is-invalid @enderror" id="description_ar"
                            name="description_ar" value="{{ old('description_ar') }}">
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="description_en" class="form-label">Description (English)</label>
                        <input type="text" placeholder="Description (English)"
                            class="form-control @error('description_en') is-invalid @enderror" id="description_en"
                            name="description_en" value="{{ old('description_en') }}">
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="categories" class="form-label fw-semibold">Categories</label>
                        <select class="form-select @error('categories') is-invalid @enderror" id="categories"
                            name="categories[]" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="text-capitalize"
                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                    {{ $category->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="api" class="form-label">API</label>
                        <input type="number" placeholder="API" class="form-control @error('api') is-invalid @enderror"
                            id="api" name="api" value="{{ old('api') }}">
                        @error('api')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="trader_id" class="form-label">Trader</label>
                        <select class="form-select @error('trader_id') is-invalid @enderror" id="trader_id"
                            name="trader_id">
                            @foreach ($traders as $trader)
                                <option value="{{ $trader->id }}"
                                    {{ old('trader_id') == $trader->id ? 'selected' : '' }}>{{ $trader->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="product_variants" class="form-label">Product Details</label>
                        <div id="product_variants">
                            <div class="product-variant">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="size" class="form-label w-100 ">Size</label>
                                        <input type="text" placeholder="Size"
                                            class="form-control @error('product_variants.0.size') is-invalid @enderror"
                                            id="size" name="product_variants[0][size]"
                                            value="{{ old('product_variants.0.size') }}">
                                        @error('product_variants.0.size')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="mileage" class="form-label">Mileage</label>
                                        <input type="text" placeholder="Mileage"
                                            class="form-control @error('product_variants.0.mileage') is-invalid @enderror"
                                            id="mileage" name="product_variants[0][mileage]"
                                            value="{{ old('product_variants.0.mileage') }}">
                                        @error('product_variants.0.mileage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="wholesale_price" class="form-label">Wholesale Price</label>
                                        <input type="number" placeholder="Wholesale Price"
                                            class="form-control @error('product_variants.0.wholesale_price') is-invalid @enderror"
                                            id="wholesale_price" name="product_variants[0][wholesale_price]"
                                            value="{{ old('product_variants.0.wholesale_price') }}">
                                        @error('product_variants.0.wholesale_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="unit_price" class="form-label">Unit Price</label>
                                        <input type="number" placeholder="Unit Price"
                                            class="form-control @error('product_variants.0.unit_price') is-invalid @enderror"
                                            id="unit_price" name="product_variants[0][unit_price]"
                                            value="{{ old('product_variants.0.unit_price') }}">
                                        @error('product_variants.0.unit_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="add-variant">Add Variant</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Product</button>
            </form>
        </div>
    </div>
@endsection

