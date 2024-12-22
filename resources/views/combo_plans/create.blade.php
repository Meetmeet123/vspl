@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2>Create Combo Plan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('combo-plans.store') }}" method="POST" id="comboPlanForm">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Combo Plan Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter combo plan name" required>
                    <div class="invalid-feedback">Please enter a valid name.</div>
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" step="0.01" required>
                    <div class="invalid-feedback">Please enter a price greater than zero.</div>
                </div>
                <div class="form-group mb-4">
                    <label for="plans" class="form-label">Select Plans:</label>
                    <select name="plans[]" id="plans" class="form-select" multiple required>
                        <option disabled>Loading plans...</option>
                    </select>
                    <div class="invalid-feedback">Please select at least one plan.</div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>




@push('scripts')
<script>
    $(document).ready(function () {
        const plansDropdown = $('#plans');

        // Fetch plans via AJAX and populate the select box
        $.ajax({
            url: '{{ route('plans.list') }}',
            method: 'GET',
            success: function (data) {
                let options = '';
                data.forEach(plan => {
                    options += `<option value="${plan.id}">${plan.name} - $${plan.price}</option>`;
                });
                plansDropdown.html(options);
            },
            error: function () {
                plansDropdown.html('<option disabled>Error loading plans</option>');
            }
        });
    });

    document.getElementById('comboPlanForm').addEventListener('submit', function (e) {
        const name = document.getElementById('name');
        const price = document.getElementById('price');
        const plans = document.getElementById('plans').selectedOptions;

        let valid = true;

        if (name.value.trim() === '') {
            name.classList.add('is-invalid');
            valid = false;
        } else {
            name.classList.remove('is-invalid');
        }

        if (price.value === '' || price.value <= 0) {
            price.classList.add('is-invalid');
            valid = false;
        } else {
            price.classList.remove('is-invalid');
        }

        if (plans.length === 0) {
            document.getElementById('plans').classList.add('is-invalid');
            valid = false;
        } else {
            document.getElementById('plans').classList.remove('is-invalid');
        }

        if (!valid) {
            e.preventDefault();
        }
    });
</script>
@endpush

@endsection
