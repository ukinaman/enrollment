@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <x-page-header title="Student Assessment" buttonType="" buttonTitle="" routeName=""  />
    <div class="page-body">
        <div class="container-xl">
          <x-student-information enrollmentId="{{ $enrollment->id }}"/>
          <x-student-subjects enrollmentId="{{ $enrollment->id }}" />
        </div>
      </div>
    </div>
  </div>
@endsection

@section('page_level_scripts')
    <script src="{{ asset('/js/subject-assessment.js') }}"></script>
@endsection