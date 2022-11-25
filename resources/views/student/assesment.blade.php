@extends('welcome')

@section('student')
<div class="container-fluid d-flex flex-column align-items-center pt-5" style="height: {{ $table == 'subjects' ? '100vh' : 'auto' }}; width: 100%; background-image: url({{ asset('images/white-background.jpg') }}); background-size: contain; background-position: start center;">
  <div class="row w-50">
    <div class="container d-flex align-items-center mb-3">
      <img class="mb-3" src="{{ asset('images/circle-logo.png') }}" alt="logo" height="90" width="90">
      <div class="container">
        <h2>Canossa College San Pablo</h2>
        <p>Lakeside Park Subdivision</p>
        <p>San Pablo City, Laguna 4000</p>
      </div>
    </div>
    <div class="row d-flex w-100 mb-3">
      <div class="col-md-6">
        <h3 style="text-transform: uppercase; font-weight: bold;">{{ $enrollment->getFullName($enrollment->id, 2) }}</h3>
      </div>
      <div class="col-md-2">
        <h3 style="font-weight: bold;">A.Y. {{ $enrollment->getCurrentAcademicYear() }}</h3>
      </div>
      <div class="col-md-4 d-flex justify-content-end">
        <h3 style="font-weight: bold;">TERM: Second Semester</h3>
      </div>
    </div>
    <table class="table table-bordered">
      <tr>
        <th colspan="3" style="text-transform: uppercase">PROGRAM DESCRIPTION: {{ $enrollment->getCourse($enrollment->course_id, 'full') }}</th>
        <th colspan="1" style="text-transform: uppercase">PROGRAM CODE: {{ $enrollment->getCourse($enrollment->course_id, 'acc') }}</th>
        <th colspan="1" style="text-transform: uppercase">YEAR LEVEL: {{ $enrollment->getYear($enrollment->year_id) }}</th>
      </tr>
    </table>
  </div>

  @yield('assesment-table')
  
  <div class="row w-50 mt-3">
    <div class="container d-flex justify-content-end gap-2 mb-3">
      <a href="{{ $table == 'subjects' ? route('student.assessment', ['enrollment_id' => $enrollment->id, 'table' => 'semestral-fee']) : route('student.assessment',  ['enrollment_id' => $enrollment->id, 'table' => 'subjects']) }}" class="btn btn-primary">Show {{ $table == 'subjects' ? 'Fees' : 'Subjects' }}</a>
      <a href="{{ route('welcome') }}" class="btn btn-success">Exit</a>
    </div>
    <h5 class="text-center text-danger">Must Read!!</h5>
    <p class="text-center">
      Number of subjects may change after the assessment of the registrar. You may proceed to the registrar to confirm your registration.
      <br>
      Thank you!
    </p>
  </div>
</div>
@endsection