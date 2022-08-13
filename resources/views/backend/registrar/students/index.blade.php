@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Students" buttonType="" buttonTitle="" routeName="" enrollee="0" />
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
                            @foreach ($enrollees as $enrollee)
                                <tr>
                                    <td>{{ $enrollee->student->getFullNameAttribute() }}</td>
                                    <td>{{ $enrollee->course->title }}</td>
                                    <td>{{ $enrollee->getYear($enrollee->year_id) }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">
                                            Assess
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection