@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-6">
                <h4>Semestral Fees</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('semfee.create') }}" class="btn btn-primary">Add</a>
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <th scope="row">Semestral Fee</th>
                    <th scope="row">Amount</th>
                </thead>

                @foreach ($sem_fees as $sem_fee)
                    <tbody>
                            <tr>
                                <td class="font-weight-bold"><strong>{{ $sem_fee->name }}</strong></td>
                                <td class="font-weight-bold"><strong><span>&#8369</span>{{ $sem_fee->amount($sem_fee->name) }}</strong></td>
                            </tr>
                            @foreach ($sem_fee->fees as $fee)
                                <tr>
                                    <td>{{ $fee->name }}</td>
                                    <td><span>&#8369</span>{{ number_format($fee->amount ) }}</td>
                                </tr>
                            @endforeach
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection