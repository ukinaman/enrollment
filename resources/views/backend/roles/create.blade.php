@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Add Role" buttonType="save" buttonTitle="" routeName="roleForm" enrollee="0"/> 
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
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
        </div>
    </div>
@endsection