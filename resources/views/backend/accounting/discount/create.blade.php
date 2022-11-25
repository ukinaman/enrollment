@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Create" buttonType="save" buttonTitle="" routeName="discountForm" enrollee="0" />
        
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                    <form action="{{ route('discount.store') }}" method="POST" class="row" id="discountForm">
                        @csrf
                        <div class="col-md-6">
                            <label for="discName" class="form-label">Discount Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="discName">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}.</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Percentage</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('percentage') is-invalid @enderror" name="percentage" value="{{ old('percentage') }}" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="input-group-text">%</span>
                            </div>
                            @error('percentage')
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