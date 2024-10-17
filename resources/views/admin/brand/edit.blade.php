@extends('layouts.admin.admin-layout')
@section('content')
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
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Brands</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Brands</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <a href="{{ route('brands.create') }}" class="btn btn-primary">Add New Brand</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Breadcrumb --}}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Brand</h4>
            <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name_ar" class="form-label">Name (Arabic)</label>
                    <input type="text" value="{{$brand->name_ar}}" placeholder="Name (Arabic)" @error('name_ar') is-invalid @enderror class="form-control" id="name_ar" name="name_ar" >
                    @error('name_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name_en" class="form-label">Name (English)</label>
                    <input type="text" value="{{$brand->name_en}}" placeholder="Name (English)" @error('name_en') is-invalid @enderror class="form-control" id="name_en" name="name_en" >
                    @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" value="{{$brand->logo}}" placeholder="Logo" class="form-control" id="logo" name="logo" accept="image/*">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>
        </div>
    </div>
@endsection

