@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-7">
              <h2>Semestral Fees</h2>
            </div>
            <div class="col-5 d-flex justify-content-end gap-2">
              <a href="{{ route('semfee.create', ['course' => $course, 'year' => 0, 'sem' => 0]) }}" class="btn btn-success text-white">
                Create
              </a>
              <a onclick="document.getElementById('assessForm').submit()" class="btn btn-primary">Show Fees</a>
            </div>
          </div>
          <div class="row mb-3">
            <x-assessment-form-component route="{{ route('semfee.fees') }}"  course="{{ $course }}" year="{{ !empty($year) ? $year : 0 }}" sem="{{ !empty($sem) ? $sem : 0 }}" model="course"/>
          </div>
          @yield('semfee-table')
        </div>
    </div>
</div>
@endsection