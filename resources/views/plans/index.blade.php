@extends('layouts.app')

@section('title', 'Plans')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Plans</h1>
        <a href="{{ route('plans.create') }}" class="btn btn-primary">Add Plan</a>
    </div>

    <table id="plansTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        $('#plansTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('plans.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'price', name: 'price' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush

@endsection
