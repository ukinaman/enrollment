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
    
    <div class="container">
        <div class="row d-flex mb-3">
            <div class="col-7">
                <h4>Subjects</h4>
            </div>
            <div class="col-5 d-flex justify-content-end gap-2">
                <a href="{{ route('subject.uploadBlade') }}" class="btn btn-success text-white">
                    Upload Subjects
                </a>
                <a onclick="document.getElementById('assessForm').submit()" class="btn btn-primary">Assess</a>
            </div>
        </div>

        <div class="row mb-3">
            <x-assessment-form-component route="{{ route('subject.show') }}" course="{{ $course }}" year="{{ $year }}" sem="{{ $sem }}"/>
        </div>

        <div class="row">
            @yield('show-subjects')
        </div>
    </div>
@endsection