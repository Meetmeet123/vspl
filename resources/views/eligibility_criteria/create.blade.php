@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">{{ isset($eligibilityCriteria) ? 'Edit' : 'Create' }} Eligibility Criteria</h1>
    <div class="card shadow-lg p-4">
        <form action="{{ isset($eligibilityCriteria) ? route('eligibility-criteria.update', $eligibilityCriteria->id) : route('eligibility-criteria.store') }}" method="POST" id="eligibilityForm">
            @csrf
            @if(isset($eligibilityCriteria))
                @method('PUT')
            @endif

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $eligibilityCriteria->name ?? '') }}" required maxlength="25">
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="age_less_than" class="form-label">Age Less Than</label>
                            <input type="number" id="age_less_than" name="age_less_than" class="form-control" value="{{ old('age_less_than', $eligibilityCriteria->age_less_than ?? '') }}" min="0" max="120">
                        </div>
                        <div class="col-md-6">
                            <label for="age_greater_than" class="form-label">Age Greater Than</label>
                            <input type="number" id="age_greater_than" name="age_greater_than" class="form-control" value="{{ old('age_greater_than', $eligibilityCriteria->age_greater_than ?? '') }}" min="0" max="120">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="last_login" class="form-label">Last Login</label>
                    <input type="datetime-local" id="last_login" name="last_login" class="form-control" value="">
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="income_less_than" class="form-label">Income Less Than</label>
                            <input type="number" id="income_less_than" name="income_less_than" class="form-control" value="{{ old('income_less_than', $eligibilityCriteria->income_less_than ?? '') }}" min="0" max="99999999">
                        </div>
                        <div class="col-md-6">
                            <label for="income_greater_than" class="form-label">Income Greater Than</label>
                            <input type="number" id="income_greater_than" name="income_greater_than" class="form-control" value="{{ old('income_greater_than', $eligibilityCriteria->income_greater_than ?? '') }}" min="0" max="99999999">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-success w-25">
                    {{ isset($eligibilityCriteria) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('eligibilityForm');

        const validateNumberField = (field, maxDigits) => {
            maxDigits = 15;
            field.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > maxDigits) {
                    this.value = this.value.slice(0, maxDigits);
                }
            });
        };

        const nameField = document.getElementById('name');
        nameField.addEventListener('input', function () {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '').slice(0, 25);
        });

        const incomeLessThan = document.getElementById('income_less_than');
        const incomeGreaterThan = document.getElementById('income_greater_than');

        validateNumberField(incomeLessThan);
        validateNumberField(incomeGreaterThan);

        const lastLoginField = $('#last_login').val();
        form.addEventListener('submit', function (e) {
            
            if (lastLoginField.value) {
                const date = new Date(lastLoginField.value);
                const formattedDate = date.toISOString().split('T')[0];
                lastLoginField.value = formattedDate;
            }

            let errorMessages = [];


            if (errorMessages.length > 0) {
                e.preventDefault();
                alert(errorMessages.join('\n'));
            }
        });
    });
</script>
@endsection
