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
                <div class="list-group list-group-flush list-group-hoverable">
                  @foreach ($enrollments as $enrollment)
                    <div class="list-group-item">
                      <div class="row align-items-center">
                        <div class="col-auto"><span class="badge {{ $enrollment->isLatestEnrollment($enrollment->student_id, $enrollment->id) ? 'bg-red' : 'bg-white'  }}"></span></div>
                        <div class="col-auto">
                          <a href="#">
                            <span class="avatar">{{ $enrollment->student->initials }}</span>
                          </a>
                        </div>
                        <div class="col text-truncate">
                          <a href="{{ route('enrollee.show', $enrollment->id) }}" class="text-reset d-block" style="font-size: 1.1rem; font-weight: bold;">{{ $enrollment->enrollmentSummary($enrollment->id) }}</a>
                          <div class="d-block text-muted text-truncate mt-n1">{{ $enrollment->getMop() }} / Enrollment Date: {{ $enrollment->parseDate($enrollment->created_at) }}</div>
                        </div>
                        <div class="col-auto">
                          @if (!$enrollment->isPaid($enrollment->id))
                          @else
                            <p>Paid</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <circle cx="12" cy="12" r="9" />
                              <path d="M9 12l2 2l4 -4" />
                            </svg>
                          @endif
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection