@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <x-page-header title="Student Assessment" buttonType="" buttonTitle="" routeName="" enrollee="0" />
    <div class="page-body">
        <div class="container-xl">
          {{-- @if ($enrollment) --}}
            <x-student-information enrollmentId="{{ $enrollment->id }}"/>
            @if ($enrollment->assessed == 0)
              <x-course-subjects enrollmentId="{{ $enrollment->id }}" />
            @else
              <x-student-subjects enrollmentId="{{ $enrollment->id }}" user="Registrar" />
            @endif
          {{-- @endif --}}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('page_level_scripts')
    <script src="{{ asset('/js/subject-assessment.js') }}"></script>
@endsection