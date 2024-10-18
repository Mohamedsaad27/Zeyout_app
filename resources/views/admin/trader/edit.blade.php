@extends('layouts.admin.admin-layout')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Edit Trader</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Traders</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <a href="{{ route('traders.index') }}" class="btn btn-primary">Back to Traders</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Breadcrumb --}}

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Edit Trader</h4>
        <form action="{{ route('traders.update', $trader->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="{{ $trader->user->user_name }}" placeholder="Name" class="form-control @error('user_name') is-invalid @enderror" id="name" name="user_name">
                    @error('user_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" value="{{ $trader->user->email }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" value="{{ $trader->user->phone_number }}" placeholder="Phone" class="form-control @error('phone_number') is-invalid @enderror" id="phone" name="phone_number">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="birth_date" class="form-label">Birth Date</label>
                    <input type="date" value="{{ $trader->user->birth_date }}" placeholder="Birth Date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date">
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" value="{{ $trader->user->profile_image }}" placeholder="Profile Image" class="form-control @error('profile_image') is-invalid @enderror" id="image" name="profile_image" accept="image/*">
                    @error('profile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="description" class="form-label">Description (Arabic)</label>
                    <textarea class="form-control" placeholder="Description (Arabic)" class="form-control @error('description_ar') is-invalid @enderror" id="description" name="description_ar" rows="3">{{ $trader->description_ar }}</textarea>
                    @error('description_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="description" class="form-label">Description (English)</label>
                    <textarea class="form-control" placeholder="Description (English)" class="form-control @error('description_en') is-invalid @enderror" id="description" name="description_en" rows="3">{{ $trader->description_en }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="facebook_url" class="form-label">Facebook URL</label>
                    <input type="text" value="{{ $trader->facebook_url }}" placeholder="Facebook URL" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url">
                    @error('facebook_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="instagram_url" class="form-label">Instagram URL</label>
                    <input type="text" value="{{ $trader->instagram_url }}" placeholder="Instagram URL" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url">
                    @error('instagram_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" value="{{ $trader->country }}" placeholder="Country" class="form-control @error('country') is-invalid @enderror" id="country" name="country">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="governate" class="form-label">Governate</label>
                    <select class="form-select" id="governate" name="governate">
                        <option value="">Select Governate</option>
                        @foreach ($governates as $governate)
                            <option value="{{ $governate->id }}" {{ $trader->governate_id == $governate->id ? 'selected' : '' }}>{{ $governate->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
