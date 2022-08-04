@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <x-page-header title="Create" buttonType="save" buttonTitle="" routeName="feeForm" enrollee="0"  />
    <div class="page-body">
        <div class="container">
            <div class="row justify-content-center">
                <form action="{{ route('semfee.store') }}" method="POST" id="feeForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="formGroupExampleInput">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="inputState" class="form-label">Category</label>
                            <select id="inputState" class="form-select @error('sem_fee_id') is-invalid @enderror" name="sem_fee_id">
                                <option value="" disabled selected>Choose Category</option>
                                @foreach ($sem_fees as $sem_fee)
                                    <option value="{{ $sem_fee->id }}">{{ $sem_fee->name }}</option>
                                @endforeach
                            </select>
                            @error('sem_fee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">Course</label>
                            <select id="inputState" class="form-select @error('exclusiveTo') is-invalid @enderror" name="exclusiveTo">
                                <option value="" disabled selected>Choose Course</option>
                                <option value="0" >All</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->accronym }}</option>
                                @endforeach
                            </select>
                            @error('exclusiveTo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Amount</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                            </div>
                            @error('amount')
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
{{-- <div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-6">
            <h4>Semestral Fees</h4>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a onclick="document.getElementById('feeForm').submit()" class="btn btn-success text-white">Save</a>
        </div>
    </div>

    <div class="row">
        
    </div>
</div> --}}
@endsection