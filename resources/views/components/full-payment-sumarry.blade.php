<h3 class="page-title my-3">FOR FULLPAYMENT</h2>
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
          <td>{{ $sem_fee->total($sem_fee->id, $course, $year, $sem) }}</td>
          <td>{{ $sem_fee->id == 1 ? $sem_fee->getDiscountPercentage().'%' : '' }}</td>
          <td>{{ $sem_fee->id == 1 ? number_format($sem_fee->getTotalDiscount($sem_fee->getDiscountPercentage(), $sem_fee->id, $course, $year, $sem), 2) : '' }}</td>
          <td class="amount-td" style="text-align: right">{{ $sem_fee->overallAmount($sem_fee->getDiscountPercentage(), $sem_fee->id, $course, $year, $sem) }}</td>
        </tr>
        @if($loop->last)
          <tr>
            <th colspan="4">TOTAL TF, SF, & EF FOR FULL PAYMENT</th>
            <th class="amount-td" style="text-align: right">{{ number_format($sem_fee->getOverAllTotalWithDiscount($sem_fee->getDiscountPercentage(), $sem_fee->id, $course, $year, $sem), 2) }}</th>
          </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>