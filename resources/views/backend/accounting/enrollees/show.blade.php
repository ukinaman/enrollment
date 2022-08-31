@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container">
        <x-page-header title="Semestral Fees" buttonType="" buttonTitle="" routeName="" enrollee="" />
        <div class="page-body">
            <div class="container">
                <x-student-information enrollmentId="{{ $enrollee->id }}"/>
                <div class="card mb-3">
                    <div class="col-md-12">
                      <div class="card">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a href="#tabs-subjects-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Subjects</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a href="#tabs-assessment-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Semestral Fees</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a href="#tabs-discount-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Discount</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a href="#tabs-summary-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Summary</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a href="#tabs-payments-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Payments</a>
                          </li>
                        </ul>
                        <div class="card-body">
                          <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-subjects-7" role="tabpanel">
                              <x-student-subjects enrollmentId="{{ $enrollee->id }}" user="Accounting" />
                            </div>
                            <div class="tab-pane" id="tabs-assessment-7" role="tabpanel">
                              <x-enrollee-semestral-fee-summary course="{{ $enrollee->course_id }}" year="{{ $enrollee->year_id }}" sem="{{ $enrollee->sem_id }}" enrollee="{{ $enrollee->id }}" />
                            </div>
                            <div class="tab-pane" id="tabs-discount-7" role="tabpanel">
                              <x-manage-discount-form enrollee="{{ $enrollee->id }}"/>
                            </div>
                            <div class="tab-pane" id="tabs-summary-7" role="tabpanel">
                              @if($enrollee->mop_id == 1)
                                <x-enrollee-full-payment-summary course="{{ $enrollee->course_id }}" year="{{ $enrollee->year_id }}" sem="{{ $enrollee->sem_id }}" enrollee="{{ $enrollee->id }}" />
                              @else
                                <x-enrollee-installment-summary course="{{ $enrollee->course_id }}" year="{{ $enrollee->year_id }}" sem="{{ $enrollee->sem_id }}" enrollee="{{ $enrollee->id }}" />
                              @endif
                            </div>
                            <div class="tab-pane" id="tabs-payments-7" role="tabpanel">
                              <x-student-payment-component enrolleeId="{{ $enrollee->id }}" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection