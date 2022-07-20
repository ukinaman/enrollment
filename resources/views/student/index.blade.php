@extends('welcome')

@section('student')
    <div class="d-flex flex-column align-items-center" style="height: 85vh; ">
        
            <img src="{{ asset('images/logo.png') }}" alt="" style=" width: 10%; margin-top: 30vh">
        
            <p style=" font-size: 30px; font-weight: bold; font-family: fantasy;">Canossa Enrollment System</p>
        
            <a href="{{ route('student.create') }}" class="btn btn-outline-primary">Enroll Now</a>
        

    </div>

@endsection