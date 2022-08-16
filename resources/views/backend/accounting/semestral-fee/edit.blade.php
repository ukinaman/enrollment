@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <x-page-header title="Create" buttonType="save" buttonTitle="" routeName="feeForm" enrollee="0" />

    <div class="page-body">
        <div class="container">
            <div class="row justify-content-center">
                <form action="{{ route('semfee.update', $fee->id) }}" method="POST" id="feeForm">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $fee->name) }}" id="formGroupExampleInput">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Category</label>
                            <select id="inputState" class="form-select @error('sem_fee_id') is-invalid @enderror" name="sem_fee_id">
                                <option value="" disabled selected>Choose Category</option>
                                @foreach ($sem_fees as $sem_fee)
                                    <option value="{{ $sem_fee->id }}" {{ $fee->sem_fee_id == $sem_fee->id ? 'selected' : '' }}>{{ $sem_fee->name }}</option>
                                @endforeach
                            </select>
                            @error('sem_fee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Amount</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount', $fee->amount) }}" aria-label="Amount (to the nearest dollar)">
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
@endsection