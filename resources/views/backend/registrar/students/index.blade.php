@extends('backend.layouts.app')

@section('content')
<div class="container" style="height: 80vh">
    <div class="row d-flex mb-3">
        <div class="col-10">
            <h4>Students</h4>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Course</th>
                    <th scope="col">Year Level</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($students as $student)
                    <tr>
                        <th>{{ $student->fullname() }}</th>
                        <th>{{ $student->course->title }}</th>
                        <th>{{ $student->current_year() }}</th>
                        <th>
                            <a href="" class="btn btn-primary">
                                Assess
                            </a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection