@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <div class="page-body">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-7">
          <h2>Subjects</h2>
        </div>
        <div class="col-5 d-flex justify-content-end gap-2">
          <a href="{{ route('subject.uploadBlade') }}" class="btn btn-success text-white">
            Upload Subjects
          </a>
          <a onclick="document.getElementById('assessForm').submit()" class="btn btn-primary">Assess</a>
        </div>
      </div>
      <div class="row mb-3">
        <x-assessment-form-component route="{{ route('subject.show') }}" course="{{ $course }}" year="{{ $year }}" sem="{{ $sem }}" model=" " />
      </div>
  
      <div class="row">
          @yield('show-subjects')
      </div>
    </div>
  </div>
</div>
@endsection