@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Students" buttonType="" buttonTitle="" routeName=""  />
        
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
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
        </div>
    </div>
@endsection