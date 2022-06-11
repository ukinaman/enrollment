@extends('welcome')

@section('student')
    <div class="container-fluid" style="height: 85vh; width: 100%; background-image: url({{ asset('images/school.jpg') }}); background-size: cover; background-position: start center;"></div>
    <footer class="py-3 my-4">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <h2>Canossa Enrollment System</h3>
            <a href="{{ route('enroll') }}" class="btn btn-primary">Enroll</a>
        </div>
    </footer>
@endsection