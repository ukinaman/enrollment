@extends('backend.accounting.semestral-fee.show')

@section('semfee-table')
<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th>Fee</th>
          <th>Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sem_fees as $sem_fee)
          <tr class="bg-light">
            <th class="text-black" colspan="5">{{ $sem_fee->name }}</th>
          </tr>
          @forelse ($sem_fee->fees as $fee)
            <tr>
              <td>{{ $fee->name }}</td>
              <td class="text-muted">
                {{ $fee->amount }}
              </td>
              <td>
                <a href="#">Edit</a>
              </td>
            </tr>
          @empty
          @endforelse
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection