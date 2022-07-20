@extends('welcome')

@section('student')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/school.jpg') }}); background-size: cover;">
        <div class="container">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Student Information
                </div>
                <div class="card-body">
                    <form action="{{ route('student.store') }}" method="POST" id="enrollForm">
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
                        <hr>
                        <div class="row">
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
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Mode of Payment</label>
                                <select id="inputState" class="form-select @error('mop') is-invalid @enderror" name="mop">
                                    <option value="" disabled selected>Choose Mode of Payment</option>
                                    @foreach ($mode_of_payment as $mop)
                                        <option @error('mop') selected @enderror value="{{ $mop->id }}">{{ $mop->mode }}</option>
                                    @endforeach
                                </select>
                                @error('mop')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-primary" onclick="document.getElementById('enrollForm').submit()">Enroll</button>
                </div>
            </div>
        </div>
    </div>
@endsection