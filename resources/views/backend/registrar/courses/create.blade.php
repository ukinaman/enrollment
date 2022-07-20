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
                <h4>Courses</h4>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <button class="btn btn-success text-white" type="button" onclick="document.getElementById('courseForm').submit()">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Save
                </button>
            </div>
        </div>
        <div class="row">
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
@endsection