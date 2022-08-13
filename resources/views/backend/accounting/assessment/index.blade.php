@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <div class="container">
        <x-page-header title="Semestral Fees" buttonType="assess" buttonTitle="Assess" routeName="assessForm" enrollee="0" />
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                    <x-assessment-form-component route="{{ route('assessment.show') }}"  course="{{ $course }}" year="{{ $year }}" sem="{{ $sem }}" model="course"/>
                    <div class="row mt-3">
                        @if (Route::currentRouteName() == 'assessment.index')
                            <div class="row mt-5">
                                <img src="{{ asset('images/search.svg') }}" alt="search here" height="200">
                            </div>
                        @else
                            @yield('assessment_table')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection