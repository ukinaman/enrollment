@extends('student.assesment')

@section('assesment-table')
<div class="w-50">
    <x-semestral-fee-sumarry course="{{ $enrollment->course_id }}" year="{{ $enrollment->year_id }}" sem="{{ $enrollment->sem_id }}" />
    <hr>
    @if ($enrollment->mop_id == 1)
      <x-full-payment-sumarry course="{{ $enrollment->course_id }}" year="{{ $enrollment->year_id }}" sem="{{ $enrollment->sem_id }}" />
    @else
      <x-down-payment-sumarry course="{{ $enrollment->course_id }}" year="{{ $enrollment->year_id }}" sem="{{ $enrollment->sem_id }}" />
    @endif
</div>
@endsection