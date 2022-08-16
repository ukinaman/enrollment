@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <x-page-header title="Courses" buttonType="add" buttonTitle="Courses" routeName="courses.create" enrollee="0"  />
  <div class="page-body">
    <div class="container">
      <div class="row justify-content-center">
        @if ($courses->count() >= 1)
          <div class="alert alert-success alert-dismissible fade show">
            <strong>Reminder</strong> <br>Creating csv file for easy uploading of subjects use these course ID's. This is important!<br><br>
            <ul>
              @foreach ($courses as $course)
                <li style="font-size: 1rem; color: black; font-weight: bold;">{{ $course->accronym.' '.'-'.' '.$course->id }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @forelse ($courses as $course)
          <div class="card p-0 mb-3">
              <h5 class="card-header">{{ $course->accronym }}</h5>
              <div class="card-body">
                  <h5 class="card-title">{{ $course->title }}</h5>
                  <p class="card-text">{{ $course->description }}</p>
                  <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary">View subjects</a>
              </div>
          </div>
        @empty
          <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
              <div class="d-flex align-items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  Seems you have to add courses first
              </div>
              <a href="{{ route('courses.create') }}" class="btn btn-primary" type="button">Add Course</a>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
