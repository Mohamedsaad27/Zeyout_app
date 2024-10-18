@extends('layouts.admin.admin-layout')

@section('content')
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Banner</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="title_ar">Title (Arabic)</label>
                                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror" placeholder="Title (Arabic)" id="title_ar" name="title_ar" value="{{old('title_ar')}}"  >
                                    @error('title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title_en">Title (English)</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" placeholder="Title (English)" id="title_en" name="title_en" value="{{old('title_en')}}"  >
                                </div>
                                @error('title_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="description_ar">Description (Arabic)</label>
                                    <textarea class="form-control @error('description_ar') is-invalid @enderror" placeholder="Description (Arabic)" id="description_ar" name="description_ar" rows="3" value="{{old('description_ar')}}"></textarea>
                                </div>
                                @error('description_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col">
                                    <label for="description_en">Description (English)</label>   
                                    <textarea class="form-control @error('description_en') is-invalid @enderror" placeholder="Description (English)" id="description_en" name="description_en" rows="3" value="{{old('description_en')}}"></textarea>
                                </div>
                                @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" placeholder="Image" id="image" name="image" value="{{old('image')}}"  >
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
