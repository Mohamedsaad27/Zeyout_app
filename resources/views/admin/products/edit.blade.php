@extends('layouts.admin.admin-layout')
@section('content')
@push('scripts')
        <script>
            @if (Session::has('errorCreate'))
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: '{{ Session::get('errorCreate') }}',
                });
            @endif
        </script>
        <style>
            .is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.is-invalid ~ .invalid-feedback {
    display: block;
}
        </style>
    @endpush
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
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Breadcrumb --}}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit on Product [{{$product->name_ar}}]</h4>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                        <input type="text" value="{{$product->name_ar}}" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="Name (Arabic)" name="name_ar" required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="name_en" class="form-label">Name (English)</label>
                        <input type="text" value="{{$product->name_en}}" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="Name (English)" name="name_en" required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <input type="text" value="{{$product->description_ar}}" class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" placeholder="Description (Arabic)" name="description_ar" required>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="description_en" class="form-label">Description (English)</label>
                        <input type="text" value="{{$product->description_en}}" class="form-control @error('description_en') is-invalid @enderror" id="description_en" placeholder="Description (English)" name="description_en" required>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="categories" class="form-label fw-semibold">Categories</label>
                        <select class="form-select" id="categories" name="categories[]" multiple required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="text-capitalize" @selected(in_array($category->id, $product->categories->pluck('id')->toArray()))>{{ $category->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-select" id="brand_id" name="brand_id" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>{{ $brand->name_ar }}</option>
                            @endforeach
                        </select>
                        <label for="api" class="form-label">API</label>
                        <input type="number" value="{{$product->api}}" class="form-control @error('api') is-invalid @enderror" id="api" name="api" >
                        @error('api')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="product_variants" class="form-label">Product Details</label>
                        <div id="product_variants">
                            @foreach($product->product_variants as $variant)
                                <div class="product-variant">
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="size" class="form-label w-100 ">Size</label>
                                            <input type="text" value="{{$variant->size}}" class="form-control" id="size" name="product_variants[{{$loop->iteration - 1}}][size]" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="mileage" class="form-label">Mileage</label>
                                            <input type="text" value="{{$variant->mileage}}" class="form-control" id="mileage" name="product_variants[{{$loop->iteration - 1}}][mileage]" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="wholesale_price" class="form-label">Wholesale Price</label>
                                            <input type="number" value="{{$variant->wholesale_price}}" class="form-control" id="wholesale_price" name="product_variants[{{$loop->iteration - 1}}][wholesale_price]" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="unit_price" class="form-label">Unit Price</label>
                                            <input type="number" value="{{$variant->unit_price}}" class="form-control" id="unit_price" name="product_variants[{{$loop->iteration - 1}}][unit_price]" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Product</button>
            </form>
        </div>
    </div>
@endsection
