@extends('welcome')

@section('student')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/white-background.jpg') }}); background-size: cover; background-position: start center;">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student information</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('student.register', ['enrollment_id' => $enrollment_id]) }}" method="POST">
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
                <div class="col-md-4">
                    <label for="formGroupExampleInput" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" id="formGroupExampleInput" placeholder="580 Whiff Oaf Lane">
                    @error('address')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="formGroupExampleInput" class="form-label">Citizenship</label>
                    <input type="text" class="form-control @error('citizenship') is-invalid @enderror" name="citizenship" value="{{ old('citizenship') }}" placeholder="Filipino" aria-label="Last name">
                    @error('citizenship')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Marital Status</label>
                    <select id="inputState" class="form-select @error('marital_status') is-invalid @enderror" name="marital_status">
                      <option value="" disabled selected>Choose Status</option>
                      <option @error('marital_status') selected @enderror>Single</option>
                      <option @error('marital_status') selected @enderror>Married</option>
                    </select>
                    @error('marital_status')
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
              <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection