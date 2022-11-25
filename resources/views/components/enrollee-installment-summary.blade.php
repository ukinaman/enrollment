<h3 class="page-title my-3">INSTALLMENT</h3>
<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th colspan="2">FEES</th>
          <th colspan="2">DISCOUNT</th>
          <th colspan="1">DOWN PAYMENT</th>
          <th style="text-align: right">AMOUNT</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sem_fees as $sem_fee)
        <tr>
          <td>{{ $sem_fee->name }}</td>
          <td>{{ $enrollment->enrolleeFeesAmount($sem_fee->id, $enrollment->id) }}</td>
          <td>{{ $sem_fee->id == 1 ? $enrollment->getEnrolleeDiscountPercentage($enrollment->id).'%' : '' }}</td>
          <td>{{ $sem_fee->id == 1 ? number_format($enrollment->getEnrolleeDiscountTotal($enrollment->id), 2) : '' }}</td>
          <td colspan="1">{{ $enrollment->enrolleeDownpaymentSumarry($sem_fee->id, $enrollment->id) }}</td>
          <td class="amount-td" style="text-align: right">{{ $enrollment->getEnrolleeDownpaymentOverallTotal($sem_fee->id, $enrollment->id) }}</td>
        </tr>
        @if($loop->last)
          <tr>
            <th>TOTAL</th>
            <th>{{ number_format($enrollment->enrolleeOverallTotal($enrollment->id), 2) }}</th>
            <th colspan="2"></th>
            <th colspan="1">{{ number_format($enrollment->getEnrolleeTotalDownpayment($enrollment->id), 2) }}</th>
            <th class="amount-td" style="text-align: right">{{ number_format($enrollment->getEnrolleeDownpaymentOverallAmount($enrollment->id), 2) }}</th>
          </tr>
          <tr>
            <th colspan="5">DIVIDED BY 3 TERMS</th>
            <th class="amount-td" style="text-align: right">/3</th>
          </tr>
          <tr>  
            <th colspan="5">PER TERM (before every exam period)</th>
            <th class="amount-td" style="text-align: right">{{ number_format($enrollment->getPerTermAmount($enrollment->id), 2) }}</th>
          </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>