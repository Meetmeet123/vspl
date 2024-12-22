@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2>Edit Combo Plan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('combo-plans.update', $comboPlan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Combo Plan Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Combo Plan Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $comboPlan->name }}" required>
                    <div class="invalid-feedback">Please enter a valid name.</div>
                </div>

                <!-- Combo Plan Price -->
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $comboPlan->price }}" required>
                    <div class="invalid-feedback">Please enter a valid price greater than zero.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="plans" class="form-label">Select Plans:</label>
                    <select name="plans[]" id="plans" class="form-select" multiple required></select>
                    <div class="invalid-feedback">Please select at least one plan.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" class="btn btn-success">Update Combo Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#plans').select2({
            placeholder: 'Select plans',
            allowClear: true,
            width: '100%'
        });
        const selectedPlans = @json($comboPlan->plans->pluck('id'));

        $.ajax({
            url: '{{ route('plans.list') }}',
            method: 'GET',
            success: function (data) {
                let options = '';
                data.forEach(plan => {
                    const selected = selectedPlans.includes(plan.id) ? 'selected' : '';
                    options += `<option value="${plan.id}" ${selected}>${plan.name} - $${plan.price}</option>`;
                });
                $('#plans').html(options);
                $('#plans').trigger('change');
            },
            error: function (xhr, status, error) {
                console.error('Error fetching plans:', error);
            }
        });
    });
</script>
@endpush

@endsection
