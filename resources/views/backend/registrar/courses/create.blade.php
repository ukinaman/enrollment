@extends('backend.layouts.app')

@section('content')
    <div class="container" style="height: 80vh">
        <div class="row d-flex mb-3">
            <div class="col-10">
                <h4>Courses</h4>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <button class="btn btn-success text-white" type="button">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Save
                </button>
            </div>
        </div>
        <div class="row">
            <form action="">
                <div class="row mb-3">
                    <div class="col-8">
                        <label for="formGroupExampleInput" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reg_header') is-invalid @enderror" value="{{ old('reg_header') }}" placeholder="Bachelor of Science in Information Technology" aria-label="First name">
                        @error('reg_header')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="formGroupExampleInput" class="form-label">Accronym<span class="text-danger">*</label>
                        <input type="text" class="form-control @error('reg_header') is-invalid @enderror" value="{{ old('reg_header') }}" placeholder="BSIT" aria-label="Last name">
                        @error('reg_header')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description<span class="text-danger">*</label>
                    <textarea class="form-control @error('reg_header') is-invalid @enderror" value="{{ old('reg_header') }}" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('reg_header')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection