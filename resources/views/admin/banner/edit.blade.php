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
                    <h4 class="fw-semibold mb-8">Banners</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Banners</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <a href="{{ route('banners.create') }}" class="btn btn-primary">Add New Banner</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Breadcrumb --}}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit on Banner [{{$banner->title_ar}}]</h4>
            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="title_ar" class="form-label">Title (Arabic)</label>
                        <input type="text" value="{{$banner->title_ar}}" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="Title (Arabic)" name="title_ar" >
                        @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="title_en" class="form-label">Title (English)</label>
                        <input type="text" value="{{$banner->title_en}}"  class="form-control @error('title_en') is-invalid @enderror" placeholder="Title (English)" id="title_en" name="title_en" >
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar" placeholder="Description (Arabic)">{{$banner->description_ar}}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="description_en" class="form-label">Description (English)</label>
                        <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" placeholder="Description (English)">{{$banner->description_en}}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" placeholder="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit Banner</button>
            </form>
        </div>
    </div>
@endsection

