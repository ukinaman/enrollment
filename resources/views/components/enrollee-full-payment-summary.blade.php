<h3 class="page-title my-3">FULLPAYMENT</h2>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th colspan="2">FEES</th>
            <th colspan="2">CASH DISCOUNT</th>
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
            <td class="amount-td" style="text-align: right">{{ $enrollment->enrolleeFeesAmountWithDiscount($sem_fee->id, $enrollment->id) }}</td>
          </tr>
          @if($loop->last)
            <tr>
              <th colspan="4">TOTAL TF, SF, & EF FOR FULL PAYMENT</th>
              <th class="amount-td" style="text-align: right">{{ number_format($enrollment->enrolleeOverallTotalWithDiscount($enrollment->id), 2) }}</th>
            </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>