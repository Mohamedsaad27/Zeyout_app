@extends('layouts.admin.admin-layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-white shadow-lg rounded-lg overflow-hidden">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Banner Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Title (English)</th>
                        <td>{{ $banner->title_en ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Title (Arabic)</th>
                        <td dir="rtl">{{ $banner->title_ar ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Description (English)</th>
                        <td>{{ $banner->description_en ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Description (Arabic)</th>
                        <td dir="rtl">{{ $banner->description_ar ?? 'N/A' }}</td>
                    </tr>
                </table>
                <div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Banner Image</p>
                        <img src="{{ $banner->image }}" alt="Banner Image" class="w-full h-auto rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush