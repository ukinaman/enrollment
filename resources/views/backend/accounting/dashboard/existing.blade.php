@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <div class="container">
    <x-page-header title="New Transaction" buttonType="enroll" buttonTitle="Enroll" routeName="enrollStudentForm" enrollee="0" />
    <div class="page-body">
      <div class="container">
          <div class="row justify-content-center">
            <div class="card mb-3">
              <div class="card-header">
                  <h3 class="card-title">Student Information</h3>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="card-body">
                          <div class="row flex-wrap">
                              <div class="col-md-3">
                                  <div class="subheader">Name</div>
                                  <p class="h3 mb-3">{{ $student->full_name }}</p>
                              </div>
                              <div class="col-md-3">
                                  <div class="subheader">Age</div>
                                  <p class="h3 mb-3">{{ $student->age }}</p>
                              </div>
                              <div class="col-md-3">
                                  <div class="subheader">Gender</div>
                                  <p class="h3 mb-3">{{ $student->gender }}</p>
                              </div>
                              <div class="col-md-3">
                                  <div class="subheader">Date of Birth</div>
                                  <p class="h3 mb-3">{{ $student->birthday }}</p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="subheader">E-mail</div>
                                  <div class="h3 mb-3">{{ $student->email }}</div>
                              </div>
                              <div class="col-md-6">
                                  <div class="subeader">Contact Number</div>
                                  <div class="h3 mb-3">{{ $student->contact_no }}</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <form action="{{ route('accounting.dashboard.existing.store', $student->id) }}" method="POST" id="enrollStudentForm">
                  @csrf
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