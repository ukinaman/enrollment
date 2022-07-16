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
              <x-student-information/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection