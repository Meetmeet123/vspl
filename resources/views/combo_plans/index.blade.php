@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Combo Plans</h1>
        <a href="{{ route('combo-plans.create') }}" class="btn btn-primary">Add Combo Plan</a>
    </div>

    <table id="comboPlansTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Plans</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>


@push('scripts')
<script>
    $(document).ready(function () {
        $('#comboPlansTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('combo-plans.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'price', name: 'price' },
                { data: 'plans', name: 'plans', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush

@endsection
