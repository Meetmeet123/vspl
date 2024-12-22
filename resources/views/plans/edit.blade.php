@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Edit Plan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('plans.update', $plan->id) }}" method="POST" id="planForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Plan Name:</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Enter the plan name" value="{{ $plan->name }}" required>
                            <small id="nameError" class="text-danger d-none">Plan name is required.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" name="price" id="price" class="form-control" 
                                   step="0.01" placeholder="Enter the price" value="{{ $plan->price }}" required>
                            <small id="priceError" class="text-danger d-none">Price must be greater than zero.</small>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('planForm').addEventListener('submit', function(e) {
        let isValid = true;

        const name = document.getElementById('name').value.trim();
        const price = document.getElementById('price').value.trim();

        // Clear previous errors
        document.getElementById('nameError').classList.add('d-none');
        document.getElementById('priceError').classList.add('d-none');

        if (name === '') {
            document.getElementById('nameError').classList.remove('d-none');
            isValid = false;
        }

        if (price === '' || price <= 0) {
            document.getElementById('priceError').classList.remove('d-none');
            isValid = false;
        }

        if (!isValid) e.preventDefault();
    });
</script>
@endpush

@endsection
