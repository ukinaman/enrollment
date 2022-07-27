@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container">
        <x-page-header title="Payments" buttonType="" buttonTitle="" routeName=""  />
        <div class="page-body">
          <div class="container">
            <x-student-information enrollmentId="{{ $enrollee->id }}"/>
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Summary</h3>
              </div>
              <div class="card-body">
                {{-- <x-invoice /> --}}
                <div>
                  <table class="table table-bordered">
                    <thead>
                      <th colspan="2">For {{ $enrollee->mop_id == 1 ? 'Full Payment' : 'Down Payment' }}</th>
                      <th colspan="2">{{ $enrollee->mop_id == 1 ? 'Cash Discount' : 'Down Payment' }}</th>
                      <th>Amount</th>
                    </thead>
                    <tbody>
                      @foreach ($sem_fees as $sem_fee)
                        <tr>
                          <td>{{ $sem_fee->name }}</td>
                          <td>{{ number_format($sem_fee->getEnrolleeSumary($sem_fee->id, $enrollee->course_id, $sem_fee->name, $enrollee->id), 2) }}</td>
                          @if ( $enrollee->mop_id == 1)
                            <td>{{ $sem_fee->name == 'Tuition' ? '5%' : '' }}</td>
                          @else
                            <td></td>
                          @endif
                          @if ( $enrollee->mop_id == 1)
                            <td>{{ $sem_fee->name == 'Tuition' ? '633.00' : '' }}</td>
                          @else
                            <td></td>
                          @endif
                          <td></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection