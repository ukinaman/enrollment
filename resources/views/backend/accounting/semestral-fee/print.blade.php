@extends('backend.layouts.app')

@section('page_level_css')
  <style>

  </style>  
@endsection

@section('content')
<div class="page-wrapper">
  <div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center mb-5">
          <div class="col">
              <h2 class="page-title">
                  Print
              </h2>
          </div>
          <div class="col-12 col-md-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="{{ route('semfee.download', ['course' => $course, 'year' => $year, 'sem' => $sem]) }}" class="btn btn-success">Download</a>
              </div>
          </div>
        </div>
        <div class="row g-2 align-items-center">
          <div class="row">
            <div class="col-2">
              <img src="{{ asset('images/circle-logo.png') }}" alt="logo" height="100" width="100" class="logo">
            </div>
            <div class="col-6 heading">
              <h1>CANOSSA COLLEGE</h1>
              <p>Lakeside Park Subdivision</p>
              <p>San Pablo City, Laguna 4000</p>
              <p>Telefax: 049 5623890 to 91</p>
              <p>Website: www..canossacollege.edu.ph</p>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection