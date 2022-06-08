@extends('backend.layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="container" style="height: 80vh">
        <div class="row d-flex mb-3">
            <div class="col-10">
                <h4>Subjects</h4>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <a href="{{ route('subject.uploadBlade') }}" class="btn btn-success text-white">
                    Upload Subjects
                </a>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Subject</th>
                        <th scope="col">Course</th>
                        <th scope="col">Year Level</th>
                        <th scope="col">Units</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($subjects as $subject)
                        <tr>
                            <th>{{ $subject->name }}</th>
                            <th>{{ $subject->course->accronym }}</th>
                            <th>{{ $subject->year->level }}</th>
                            <th>{{ $subject->units }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection