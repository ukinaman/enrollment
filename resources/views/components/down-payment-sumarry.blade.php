<h3 class="page-title my-3">FOR INSTALLMENT BASIS</h3>
<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th colspan="2">FEES</th>
          <th colspan="2">DOWN PAYMENT</th>
          <th style="text-align: right">AMOUNT</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sem_fees as $sem_fee)
        <tr>
          <td>{{ $sem_fee->name }}</td>
          <td>{{ $sem_fee->total($sem_fee->id, $course, $year, $sem) }}</td>
          <td colspan="2">{{ $sem_fee->downpaymentSumarry($sem_fee->id, $course, $year, $sem) }}</td>
          <td class="amount-td" style="text-align: right">{{ $sem_fee->getDownpaymentOverallTotal($sem_fee->id, $course, $year, $sem) }}</td>
          {{-- <td class="amount-td">{{ $sem_fee->isLessThan5K($sem_fee->id, $course, $year, $sem) }}</td> --}}
        </tr>
        @if($loop->last)
          <tr>
            <th>TOTAL</th>
            <th>{{ number_format($sem_fee->getOverallTotal($course, $year, $sem), 2) }}</th>
            <th colspan="2">{{ number_format($sem_fee->getTotalDownpayment($sem_fee->id, $course, $year, $sem), 2) }}</th>
            <th class="amount-td" style="text-align: right">{{ number_format($sem_fee->getDownpaymentOverallAmount($course, $year, $sem), 2) }}</th>
          </tr>
          <tr>
            <th colspan="4">DIVIDED BY 3 TERMS</th>
            <th class="amount-td" style="text-align: right">/3</th>
          </tr>
          <tr>  
            <th colspan="4">PER TERM (before every exam period)</th>
            <th class="amount-td" style="text-align: right">{{ number_format($sem_fee->getPerTermAmount($course, $year, $sem), 2) }}</th>
          </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>