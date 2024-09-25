@extends('layouts.admin.admin-layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Dashboard</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text display-4">{{ $categoriesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text display-4">{{ $productsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Brands</h5>
                    <p class="card-text display-4">{{ $brandsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $usersCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <!-- Add more dashboard widgets as needed -->
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Categories</h5>
                    <ul class="list-group">
                        @forelse($recentCategories ?? [] as $category)
                            <li class="list-group-item">{{ $category->name }}</li>
                        @empty
                            <li class="list-group-item">No recent categories</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Products</h5>
                    <ul class="list-group">
                        @forelse($recentProducts ?? [] as $product)
                            <li class="list-group-item">{{ $product->name }}</li>
                        @empty
                            <li class="list-group-item">No recent products</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
