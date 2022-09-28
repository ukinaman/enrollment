@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <div class="container">
    <x-page-header title="New Transaction" buttonType="" buttonTitle="" routeName="" enrollee="0" />
    <div class="page-body">
      <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-3">
              <a href="{{ route('accounting.dashboard.new') }}" class="card card-link card-link-pop">
                <div class="card-status-top bg-success"></div>
                <div class="card-body d-flex flex-column align-items-center gap-2">
                  <img src="{{ asset('images/new.svg') }}" alt="" height="200" width="200">
                  <h3 class="card-title" style="font-size: 1.3rem; font-weight: bold;">New Student</h3>
                </div>
              </a>
            </div>
            <div class="col-3">
              <a href="{{ route('accounting.dashboard.existing') }}" class="card card-link card-link-pop">
                <div class="card-status-top bg-primary"></div>
                <div class="card-body d-flex flex-column align-items-center gap-2">
                  <img src="{{ asset('images/following.svg') }}" alt="" height="200" width="200">
                  <h3 class="card-title" style="font-size: 1.3rem; font-weight: bold;">Existing Student</h3>
                </div>
              </a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection