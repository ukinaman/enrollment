@extends('backend.accounting.assessment.index')

@section('assessment_table')
    <table class="table table-bordered">
        <thead>
            <th scope="row">Semestral Fee</th>
            <th scope="row">Amount</th>
        </thead>

        @foreach ($sem_fees as $sem_fee)
            <tbody>
                    <tr>
                        <td class="font-weight-bold" colspan="3"><strong>{{ $sem_fee->name }}</strong></td>
                        {{-- <td class="font-weight-bold"><strong><span>&#8369</span>{{ $sem_fee->amount($sem_fee->name) }}</strong></td> --}}
                    </tr>
                    @forelse ($sem_fee->fees as $fee)
                        <tr>
                            <td>
                                @if ($fee->name == 'Tuition')
                                    {{ $fee->name.' '.'('.$fee->geTotalUnits($course, $year, $sem).' units * Php '.number_format($fee->amount, 2).') ' }}
                                    @if($fee->getCourse($course) == 'BSN')
                                        <span class="text-danger">*RLE units are not included on the computation</span>
                                    @endif
                                @elseif($fee->name == 'RLE')
                                    {{ $fee->name.' '.'('.$fee->geTotalLab($course, $year,$sem).' hours * Php '.number_format($fee->amount, 2).') ' }}
                                @else
                                    {{ $fee->name }}
                                @endif
                            </td>
                            <td><span>&#8369</span>{{ number_format($fee->totalAmount($course, $year, $sem, $fee->name), 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">No Data</td>
                        </tr>
                    @endforelse
            </tbody>
        @endforeach
    </table>
@endsection