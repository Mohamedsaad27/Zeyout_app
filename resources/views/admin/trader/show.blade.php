@extends('layouts.admin.admin-layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $trader->user->profile_image }}" alt="{{ $trader->user->user_name }}" class="img-fluid rounded shadow-sm mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Contact Information</h4>
                    <p class="card-text"><i class="fas fa-envelope me-2"></i> {{ $trader->user->email }}</p>
                    <p class="card-text"><i class="fas fa-phone me-2"></i> {{ $trader->user->phone_number }}</p>
                    <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i> {{ $trader->user->country }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Social Media</h4>
                    <a href="{{ $trader->facebook_url }}" class="btn btn-outline-primary me-2">
                        <i class="fab fa-facebook-f"></i> <!-- Updated to 'fab' for Facebook -->
                    </a>
                    <a href="{{ $trader->instagram_url }}" class="btn btn-outline-danger">
                        <i class="fab fa-instagram"></i> <!-- 'fab' is correct for Instagram -->
                    </a>
                </div>
                
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="mb-4">{{ $trader->user->user_name }} <small class="text-muted">(Trader)</small></h1>
            <p class="lead">{{ $trader->description_en }}</p>
            
            <div class="mb-4">
                <h4>Personal Details</h4>
                <p><strong>Birth Date:</strong> {{ $trader->user->birth_date }}</p>
                <p><strong>Governate:</strong> {{ $trader->governate->name_en }}</p>
            </div>
            
            <div class="mb-4">
                <h4>Products</h4>
                <div class="d-flex flex-wrap">
                    @foreach($trader->products as $product)
                        <span class="badge bg-primary me-2">{{ $product->name_en }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <h2 class="mb-4">Trader's Products</h2>
        <div class="row">
            @foreach($trader->products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name_en }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name_en }}</h5>
                        <p class="card-text">{{ Str::limit($product->description_en, 100) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Details</a>
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
    .img-fluid {
        max-height: 300px;
        object-fit: cover;
    }
    .badge {
        font-size: 0.9em;
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .btn-outline-primary, .btn-outline-danger {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        padding: 0;
        line-height: 40px;
        text-align: center;
    }
</style>
@endpush