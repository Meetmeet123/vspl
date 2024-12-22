@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">{{ __('Welcome back!') }}</h3>
                    <p class="mt-2">{{ __("You're logged in and ready to explore.") }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- View Plans -->
                <div class="bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition">
                    <a href="{{ route('plans.index') }}" class="block p-6 text-center">
                        <h3 class="text-xl font-semibold">View Plans</h3>
                        <p class="mt-2">Manage and explore individual plans.</p>
                    </a>
                </div>
                <!-- View Combo Plans -->
                <div class="bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition">
                    <a href="{{ route('combo-plans.index') }}" class="block p-6 text-center">
                        <h3 class="text-xl font-semibold">View Combo Plans</h3>
                        <p class="mt-2">Manage and create combo plans with ease.</p>
                    </a>
                </div>
                <!-- Eligibility Criteria -->
                <div class="bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-600 transition">
                    <a href="{{ route('eligibility-criteria.index') }}" class="block p-6 text-center">
                        <h3 class="text-xl font-semibold">Eligibility Criteria</h3>
                        <p class="mt-2">Define and manage eligibility criteria.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
