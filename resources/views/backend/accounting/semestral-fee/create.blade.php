@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <x-page-header title="Create" buttonType="save" buttonTitle="" routeName="feeForm" enrollee="0"  />
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
            <h3>Fee addedd successfully!</h3>
              <div class="text-muted">Do you want to add fee for {{ Session::get('data')['course_name'].' '.Session::get('data')['year_name'].' '.'-'.' '.Session::get('data')['semester_name'] }}?</div>
              <form action="{{ route('semfee.fees') }}" method="GET" id="redirectToFees" hidden>
                @csrf
                <input type="text" name="course" value="{{ Session::get('data')['course'] }}">
                <input type="text" name="year" value="{{ Session::get('data')['year'] }}">
                <input type="text" name="sem" value="{{ Session::get('data')['semester'] }}">
              </form>
          </div>
          <div class="modal-footer">
            <div class="w-100">
              <div class="row">
                <div class="col">
                  <a href="#" class="btn w-100" onclick="document.getElementById('redirectToFees').submit()">
                    Go to Fees
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
                <form action="{{ route('semfee.store') }}" method="POST" id="feeForm">
                    @csrf
                    <div class="row mb-3">
                      <div class="col-md-4">
                          <label for="inputState" class="form-label">Course</label>
                          <select id="inputState" class="form-select @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}">
                              <option>Choose...</option>
                              @foreach ($courses as $course)
                                  <option value="{{ $course->id }}" {{ $paramCourse == $course->id ? 'selected' : '' }}>{{ $course->accronym }}</option>
                              @endforeach
                          </select>
                          @error('course')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="col-md-4">
                          <label for="inputState" class="form-label">Year</label>
                          <select id="inputState" class="form-select @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}">
                              <option>Choose...</option>
                              @foreach ($years as $year)
                                  <option value="{{ $year->id }}" {{ Session::get('data')['year'] == $year->id ? 'selected' : '' }}>{{ $year->title }}</option>
                              @endforeach
                          </select>
                          @error('year')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="col-md-4">
                          <label for="inputState" class="form-label">Semester</label>
                          <select id="inputState" class="form-select @error('sem') is-invalid @enderror" name="sem" value="{{ old('sem') }}">
                              <option>Choose...</option>
                              @foreach ($semesters as $semester)
                                  <option value="{{ $semester->id }}" {{ Session::get('data')['semester'] == $semester->id ? 'selected' : '' }}>{{ $semester->title }}</option>
                              @endforeach
                          </select>
                          @error('sem')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="feeName" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="feeName">
                            <datalist id="feeName">
                              <option value="Tuition">Tuition</option>
                              <option value="Registration">Registration</option>
                              <option value="E-Library">E-Library</option>
                              <option value="Guidance">Guidance</option>
                              <option value="Development Fee">Development Fee</option>
                              <option value="Energy Fee">Energy Fee</option>
                              <option value="Nursing Skills Laboratory Fee">Nursing Skills Laboratory Fee</option>
                              <option value="Clinical Form">Clinical Form</option>
                              <option value="School Fee">School Fee</option>
                              <option value="SAP">SAP</option>
                              <option value="E-Learning">E-Learning</option>
                              <option value="RLE">RLE</option>
                            </datalist>
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
                                    <option value="{{ $sem_fee->id }}">{{ $sem_fee->name }}</option>
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
@endsection