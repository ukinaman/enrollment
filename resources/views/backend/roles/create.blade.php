@extends('backend.layouts.app')

@section('content')
    <div class="container" style="height: 80vh">
        <div class="row d-flex mb-3">
            <div class="col-10">
                <h4>Roles</h4>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <button class="btn btn-success text-white" type="button" onclick="document.getElementById('roleForm').submit()">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Save
                </button>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('roles.store') }}" method="POST" id="roleForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="formGroupExampleInput" class="form-label">Role<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" placeholder="Registrar" aria-label="Role">
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection