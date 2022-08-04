@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">
        <x-page-header title="Dashboard" buttonType="" buttonTitle="" routeName="" enrollee="0"  />
        <div class="page-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <x-to-acomodate-enrollees />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection