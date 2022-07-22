@extends('welcome')

@section('student')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/school.jpg') }}); background-size: cover;">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Assesment
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>{{ "Name: ".$student->fullname }}</h5>
                            <h5>{{ "Course: ".$course->title." "."(".$course->accronym.")" }}</h5>
                            <h5>{{ "Units allowed: 24" }}</h5>
                        </div>
                        <div class="col-md-4">
                            <h5>{{ "Year: ".$student->current_year($enrollment->year_id) }}</h5>
                            <h5>{{ "Semester: ".$student->current_sem($enrollment->sem_id) }}</h5>
                            <h5>{{ "Total units: ".$course->subjects->sum('units') }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Subject Code</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->subjects as $subject)
                                    <tr>
                                        <th scope="row">{{ $subject->code }}</th>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->units }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-primary" onclick="document.getElementById('enrollForm').submit()">Enroll</button>
                </div>
            </div>
        </div>
    </div>
@endsection