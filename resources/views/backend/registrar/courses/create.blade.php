@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Courses" buttonType="save" buttonTitle="" routeName="courseForm" enrollee="0" />
        
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                <form action="{{ route('courses.store') }}" method="POST" id="courseForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-8">
                        <label for="formGroupExampleInput" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Bachelor of Science in Information Technology" aria-label="First name">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="formGroupExampleInput" class="form-label">Accronym<span class="text-danger">*</label>
                        <input type="text" class="form-control @error('accronym') is-invalid @enderror" name="accronym" value="{{ old('accronym') }}" placeholder="BSIT" aria-label="Last name">
                        @error('accronym')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description<span class="text-danger">*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </form>
                </div>
            </div>
        </div>
    </div> 
@endsection