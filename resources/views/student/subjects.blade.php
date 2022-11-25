@extends('student.assesment')

@section('assesment-table')
<div class="row w-50">
  <table class="table table-bordered" style="background-color: white">
    <tr>
      <th colspan="1" style="text-transform: uppercase">SUBJECT CODE</th>
      <th colspan="3" style="text-transform: uppercase">SUBJECT TITLE</th>
      <th colspan="1" style="text-transform: uppercase; text-align: right">UNITS</th>
    </tr>
    @foreach ($enrollment->getCourseSubjects($enrollment->id) as $subject)
      <tr>
        <th colspan="1" style="text-transform: uppercase">{{ $subject->code }}</th>
        <th colspan="3">{{ $subject->name }} {{ $subject->lab != 0 ? '('.$subject->lab.')' : '' }}</th>
        <th colspan="1" style="text-align: right">{{ $subject->units }}</th>
      </tr>
      @if($loop->last)
        <tr>
          <th colspan="4">TOTAL UNITS</th>
          <th class="amount-td" style="text-align: right">{{ $enrollment->getCourseSubjects($enrollment->id)->sum('units') }}</th>
        </tr>
      @endif
    @endforeach
  </table>
</div>
@endsection