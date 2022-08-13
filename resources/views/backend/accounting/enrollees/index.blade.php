@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="container">
        <x-page-header title="Enrollees" buttonType="" buttonTitle="" routeName="" enrollee="0"  />
        <div class="page-body">
          <div class="container">
            <div class="row justify-content-center">
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Assessment</h3>
                </div>
                <div class="card-body">
                  <livewire:enrollees-table/>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('page_level_scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
      $(window).on("load", function() {
        $(".assess-btn").attr("target", '_self');
      });
  </script>
@endsection