@extends('layouts.admin.admin-layout')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Governates</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Governates</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <a href="{{ route('governates.create') }}" class="btn btn-primary">Add New Governate</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Governate</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('governates.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name_ar">Name (Arabic)</label>
                                <input type="text" placeholder="Name (Arabic)" @error('name_ar') class="form-control is-invalid mt-2" @else class="form-control mt-2" @enderror id="name_ar" name="name_ar" >
                                @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name_en">Name (English)</label>
                                <input type="text" placeholder="Name (English)" @error('name_en') class="form-control is-invalid mt-2" @else class="form-control mt-2" @enderror id="name_en" name="name_en" >
                                @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
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
