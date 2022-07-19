@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Dashboard" buttonType="" buttonTitle="" routeName=""  />
        
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                    <h1>Welcome Accountant</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-6">
                <h4>Semestral Fees</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a onclick="document.getElementById('assessForm').submit()" class="btn btn-primary">Assess</a>
            </div>
        </div>

        <div class="row mb-4">
            <x-assessment-form-component route="{{ route('assessment.show') }}"  course="{{ $course }}" year="{{ $year }}" sem="{{ $sem }}"/>
        </div>

        <div class="row">
            @if (Route::currentRouteName() == 'assessment.index')
                <div class="row mt-5">
                    <img src="{{ asset('images/search.svg') }}" alt="search here" height="200">
                </div>
            @else
                @yield('assessment_table')
            @endif
        </div>
    </div>
@endsection