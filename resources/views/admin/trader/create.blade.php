@extends('layouts.admin.admin-layout')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Traders</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Traders</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <a href="{{ route('traders.create') }}" class="btn btn-primary">Add New Trader</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Breadcrumb --}}

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Create New Trader</h4>
        <form action="{{ route('traders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">

@endsection
