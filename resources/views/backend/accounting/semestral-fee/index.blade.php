@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <x-page-header title="Semestral Fees" buttonType="" buttonTitle="" routeName="" enrollee="0" />
    
    <div class="page-body">
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Courses</h3>
                  </div>
                  <div class="list-group list-group-flush">
                    @foreach ($courses as $course)
                      <a href="{{ route('semfee.show', $course->id) }}" class="list-group-item list-group-item-action">
                        <h4>{{ $course->title }} ({{ $course->accronym }})</h4>
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection