@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container">
        <x-page-header title="Payments" buttonType="" buttonTitle="" routeName="" enrollee="0" />
        <div class="page-body">
          <div class="container">
            <x-student-information enrollmentId="{{ $enrollee->id }}"/>
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Summary</h3>
              </div>
              <div class="card-body">
                @if ($enrollee->getMop() == "Full Payment")
                  <x-full-payment-invoice enrolleeId="{{ $enrollee->id }}" />
                @else
                  <x-downpayment-invoice enrolleeId="{{ $enrollee->id }}" />
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection