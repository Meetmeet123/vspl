@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Eligibility Criteria</h1>
        <a href="{{ route('eligibility-criteria.create') }}" class="btn btn-primary mb-3">Add Eligibility</a>
    </div>

    <table id="eligibilityCriteriaTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age Less Than</th>
                <th>Age Greater Than</th>
                <th>Last Login (Days Ago)</th>
                <th>Income Less Than</th>
                <th>Income Greater Than</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>



@push('scripts')
<script>
    $(document).ready(function () {
        $('#eligibilityCriteriaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('eligibility-criteria.data') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'age_less_than', name: 'age_less_than' },
                { data: 'age_greater_than', name: 'age_greater_than' },
                { 
                    data: 'last_login_days_ago', 
                    name: 'last_login_days_ago', 
                    render: function(data, type, row) {
                        if (data) {
                            const date = new Date(data);
                            return date.toISOString().split('T')[0];
                        }
                        return 'N/A';
                    }
                },
                { data: 'income_less_than', name: 'income_less_than' },
                { data: 'income_greater_than', name: 'income_greater_than' },
                { 
                    data: 'actions', 
                    name: 'actions', 
                    orderable: false, 
                    searchable: false 
                },
            ]
        });
    });
</script>
@endpush

@endsection
