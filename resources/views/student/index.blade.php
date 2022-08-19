@extends('welcome')

@section('student')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/white-background.jpg') }}); background-size: cover; background-position: start center;">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="container d-flex justify-content-center align-items-center">
          <img class="mb-3" src="{{ asset('images/circle-logo.png') }}" alt="logo" height="170" width="170">
        </div>
        <h3 class="page-title mb-3">Canossa Enrollment System</h3>
        <a href="{{ route('student.create') }}" class="btn btn-primary">Enroll Now</a>
      </div>
    </div>
@endsection