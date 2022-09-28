@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <div class="container">
    <x-page-header title="New Transaction" buttonType="enroll" buttonTitle="Enroll" routeName="enrollStudentForm" enrollee="0" />
    <div class="page-body">
      <div class="container">
          <div class="row justify-content-center">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student information</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('accounting.dashboard.store') }}" method="POST" id="enrollStudentForm">
                  @csrf
                  <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="formGroupExampleInput" class="form-label">First name</label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" id="formGroupExampleInput" placeholder="first name">
                        @error('firstname')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="formGroupExampleInput" class="form-label">Middle name</label>
                        <input type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" placeholder="Middle name" aria-label="middle name">
                        @error('middlename')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="formGroupExampleInput" class="form-label">Last name</label>
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="Last name" aria-label="Last name">
                        @error('lastname')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="formGroupExampleInput" class="form-label">Birthplace</label>
                        <input type="text" class="form-control @error('birthplace') is-invalid @enderror" name="birthplace" value="{{ old('birthplace') }}" id="formGroupExampleInput" placeholder="San Pablo City">
                        @error('birthplace')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="formGroupExampleInput" class="form-label">Age</label>
                        <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" placeholder="23" aria-label="Last name">
                        @error('age')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="formGroupExampleInput" class="form-label">Birthday</label>
                        <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" placeholder="Last name" aria-label="Last name">
                        @error('birthday')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="inputState" class="form-label">Gender</label>
                        <select id="inputState" class="form-select @error('gender') is-invalid @enderror" name="gender">
                          <option value="" disabled selected>Choose Gender</option>
                          <option @error('gender') selected @enderror value="Male">Male</option>
                          <option @error('gender') selected @enderror Value="Female">Female</option>
                        </select>
                        @error('gender')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="formGroupExampleInput" class="form-label">E-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="formGroupExampleInput" placeholder="johndoe@gmail.com" style="text-transform: lowercase;">
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="formGroupExampleInput" class="form-label">Contact Number</label>
                        <input type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" placeholder="09123456782" aria-label="Last name">
                        @error('contact_no')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Course</label>
                        <select id="inputState" class="form-select @error('course_id') is-invalid @enderror" name="course_id">
                            <option value="" disabled selected>Choose Course</option>
                            @foreach ($courses as $course)
                                <option @error('course_id') selected @enderror value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Year</label>
                        <select id="inputState" class="form-select @error('year_id') is-invalid @enderror" name="year_id">
                            <option value="" disabled selected>Choose Year</option>
                            @foreach($years as $year)
                                <option @error('year_id') selected @enderror value="{{ $year->id }}">{{ $year->title }}</option>
                            @endforeach
                        </select>
                        @error('year_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                      <label for="inputState" class="form-label">Semester</label>
                      <select id="inputState" class="form-select @error('sem_id') is-invalid @enderror" name="sem_id">
                          <option value="" disabled selected>Choose Semester</option>
                          @foreach ($semesters as $semester)
                              <option @error('sem_id') selected @enderror value="{{ $semester->id }}">{{ $semester->title }}</option>
                          @endforeach
                      </select>
                      @error('sem_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label class="form-label">Units</label>
                      <input type="number" class="form-control @error('units') is-invalid @enderror" name="units" value="{{ old('units') }}" placeholder="Units">
                      @error('units')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">RLE</label>
                      <input type="number" class="form-control @error('rle') is-invalid @enderror" name="rle" value="{{ old('rle') }}" placeholder="RLE Hours">
                      @error('rle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label required">Mode of payment</label>
                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                      @foreach ($mop as $item)
                        <label class="form-selectgroup-item flex-fill">
                          <input type="radio" name="mode" value="{{ old('mode', $item->id) }}" class="form-selectgroup-input @error('mode') is-invalid @enderror">
                          <div class="form-selectgroup-label d-flex align-items-center p-3">
                            <div class="me-3">
                              <span class="form-selectgroup-check"></span>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <strong>{{ $item->mode }}</strong>
                              @if ($item->id == 1)
                                <p>You'll get a 5% discount if you proceed with Full Payment.</p>
                              @endif
                            </div>
                          </div>
                        </label>
                      @endforeach
                    </div> 
                    @error('mode')
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
    </div>
  </div>
</div>
@endsection