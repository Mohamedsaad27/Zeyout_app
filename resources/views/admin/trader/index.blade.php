@extends('layouts.admin.admin-layout')
@section('content')
@push('scripts')
        <script>
            @if (Session::has('successCreate'))
                iziToast.success({
                    title: 'Success',
                    position: 'topRight',
                    message: '{{ Session::get('successCreate') }}',
                });
            @endif

            @if (Session::has('successDelete'))
                iziToast.success({
                    title: 'Success',
                    position: 'topRight',
                    message: '{{ Session::get('successDelete') }}',
                });
            @endif

            @if (Session::has('errorDelete'))
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: '{{ Session::get('errorDelete') }}',
                });
            @endif
            @if (Session::has('successUpdate'))
                iziToast.success({
                    title: 'Success',
                    position: 'topRight',
                    message: '{{ Session::get('successUpdate') }}',
                });
            @endif

            // Add this script to handle the delete confirmation modal
            $(document).ready(function() {
                $('.delete-trader').click(function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    $('#confirmDeleteModal').modal('show');
                    $('#confirmDelete').click(function() {
                        form.submit();
                    });
                });
            });
        </script>
    @endpush
    {{-- Start Breadcrumb --}}
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
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Birth Date</th>
                            <th>Country</th>
                            <th>Profile Image</th>
                            <th>Governate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($traders as $trader)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="fw-semibold mb-0">{{ $trader->user->user_name ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $trader->user->email ?? 'N/A' }}</td>
                                <td>{{ $trader->user->phone_number ?? 'N/A' }}</td>
                                <td>{{ $trader->user->birth_date ?? 'N/A' }}</td>
                                <td>{{ $trader->user->country ?? 'N/A' }}</td>
                                <td>
                                    <img src="{{ $trader->user->profile_image ?? 'N/A' }}" alt="Profile Image" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>{{ $trader->governate->name_en ?? 'N/A' }}</td>
                                <td>
                                    <div class="action-btn d-flex">
                                        <a href="{{ route('traders.show', $trader->id) }}" class="text-info edit me-2">
                                            <i class="ti ti-eye fs-5"></i>
                                        </a>
                                        <a href="{{ route('traders.edit', $trader->id) }}" class="text-primary edit me-2">
                                            <i class="ti ti-edit fs-5"></i>
                                        </a>
                                        <form action="{{ route('traders.destroy', $trader->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-transparent border-0 delete-banner">
                                                <i class="ti ti-trash text-danger fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No traders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this trader?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection

