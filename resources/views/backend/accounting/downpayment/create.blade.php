@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <div class="container">
        <x-page-header title="Add Down Payment" buttonType="save" buttonTitle="" routeName="downpaymentForm" enrollee="0" />
        @if(session('success'))
          <script>
            $(document).ready(function() {
              $('#modal-success').modal('show');
              console.log('suceess');
            });
          </script>
        @endif
        <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
              {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
              <div class="modal-status bg-success"></div>
              <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg>
                <h3>Downp payment amount addedd successfully!</h3>
                  <div class="text-muted">Do you want to add another down payment amount?</div>
              </div>
              <div class="modal-footer">
                <div class="w-100">
                  <div class="row">
                    <div class="col">
                      <a href="{{ route('downpayment.index') }}" class="btn w-100">
                        Go to Down Payment
                      </a>
                    </div>
                    <div class="col"><a href="#" class="btn btn-success w-100" data-bs-dismiss="modal">
                        Add
                      </a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
                  <form action="{{ route('downpayment.store') }}" method="POST" id="downpaymentForm">
                    @csrf
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Course</label>
                        <select id="inputState" class="form-select @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}">
                            <option>Choose...</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->accronym }}</option>
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
  </div>
@endsection