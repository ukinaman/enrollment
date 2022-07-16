@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <x-page-header title="Student Assessment" buttonType="" buttonTitle="" routeName=""  />
    <div class="page-body">
        <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Base info</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="card-body">
                <div class="row flex-wrap">
                  <div class="col-md-3">
                    <div class="subheader">Name</div>
                    <p class="h3 mb-3">Judah Praise De Ocampo</p>
                  </div>
                  <div class="col-md-3">
                    <div class="subheader">Age</div>
                    <p class="h3 mb-3">23</p>
                  </div>
                  <div class="col-md-3">
                    <div class="subheader">Gender</div>
                    <p class="h3 mb-3">Male</p>
                  </div>
                  <div class="col-md-3">
                    <div class="subheader">Date of Birth</div>
                    <p class="h3 mb-3">April 15 1999</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="subheader">E-mail</div>
                    <div class="h3 mb-3">judahpraiseocampo@gmail.com</div>
                  </div>
                  <div class="col-md-6">
                    <div class="subeader">Contact Number</div>
                    <div class="h3 mb-3">09186286277</div>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection