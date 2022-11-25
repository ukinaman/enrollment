@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">
        <x-page-header title="Student Assessment" buttonType="" buttonTitle="" routeName="" enrollee="0"  />

        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                    <x-students-table user="registrar"/>
                </div>
            </div>
        </div>
    </div>
@endsection
