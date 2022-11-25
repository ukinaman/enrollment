@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <div class="container">
        <x-page-header title="Add Down Payment" buttonType="save" buttonTitle="" routeName="downpaymentForm" enrollee="0" />
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                  <form action="{{ route('downpayment.update', $downpayment->id) }}" method="POST" id="downpaymentForm">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Course</label>
                        <select id="inputState" class="form-select @error('course') is-invalid @enderror" name="course" value="{{ old('course', $downpayment->getCourse($downpayment->course_id)) }}">
                            <option>Choose...</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{  $downpayment->course_id == $course->id ? 'selected' : '' }}>{{ $course->accronym }}</option>
                            @endforeach
                        </select>
                        @error('course')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="formGroupExampleInput" class="form-label">Amount</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">&#8369</span>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount',$downpayment->amount) }}" aria-label="Amount (to the nearest dollar)">
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
  </div>
@endsection