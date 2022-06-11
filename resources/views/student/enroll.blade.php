@extends('welcome')

@section('student')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/school.jpg') }}); background-size: cover; background-position: start center;">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Student Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">First name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="first name">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Middle name</label>
                            <input type="text" class="form-control" placeholder="Last name" aria-label="middle name">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Last name</label>
                            <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="formGroupExampleInput" class="form-label">Birthplace</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="San Pablo City">
                        </div>
                        <div class="col-md-2">
                            <label for="formGroupExampleInput" class="form-label">Age</label>
                            <input type="text" class="form-control" placeholder="23" aria-label="Last name">
                        </div>
                        <div class="col-md-2">
                            <label for="formGroupExampleInput" class="form-label">Birthday</label>
                            <input type="date" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">Gender</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Address</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="580 Whiff Oaf Lane">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Citezenship</label>
                            <input type="text" class="form-control" placeholder="Filipino" aria-label="Last name">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Marital Status</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose Status</option>
                                <option>Single</option>
                                <option>Married</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="formGroupExampleInput" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="johndoe@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label for="formGroupExampleInput" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" placeholder="09123456782" aria-label="Last name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Course</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose Course</option>
                                <option>Single</option>
                                <option>Married</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Year</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose Year</option>
                                <option>Single</option>
                                <option>Married</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Semester</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose Semester</option>
                                <option>Single</option>
                                <option>Married</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="#" class="btn btn-primary">Enroll</a>
                </div>
            </div>
        </div>
    </div>
@endsection