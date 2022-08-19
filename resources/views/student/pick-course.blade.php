@extends('welcome')

@section('student')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/white-background.jpg') }}); background-size: cover; background-position: start center;">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Choose course</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('student.course') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label required">Course</label>
                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                  @foreach ($courses as $course)
                    <label class="form-selectgroup-item flex-fill">
                      <input type="radio" name="course" value="{{ old('course', $course->id) }}" class="form-selectgroup-input @error('course') is-invalid @enderror">
                      <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                          <span class="form-selectgroup-check"></span>
                        </div>
                        <div>
                          <strong>{{ $course->title }}</strong>
                        </div>
                      </div>
                    </label>
                  @endforeach
                </div> 
                @error('course')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <div class="form-label required">Year</div>
                <select class="form-select @error('year') is-invalid @enderror" name="year">
                  <option value="" selected>Choose...</option>
                  @foreach ($years as $year)
                    <option value="{{ $year->id }}">{{ $year->title }}</option>
                  @endforeach
                </select>
                @error('year')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <div class="form-label required">Semester</div>
                <select class="form-select @error('sem') is-invalid @enderror" name="sem">
                  <option value="" selected>Choose...</option>
                  @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->title }}</option>
                  @endforeach
                </select>
                @error('sem')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection