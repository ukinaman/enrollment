<div>
  <table class="table table-bordered">
    <thead>
      <th colspan="2">For {{ $enrollee->mop_id == 1 ? 'Full Payment' : 'Down Payment' }}</th>
      <th colspan="2">{{ $enrollee->mop_id == 1 ? 'Cash Discount' : 'Down Payment' }}</th>
      <th>Amount</th>
    </thead>
    <tbody>
      @foreach ($sem_fees as $sem_fee)
        @if ($sem_fee->id != 3)
          <tr>
            <td>{{ $sem_fee->name }}</td>
            <td class="amount">{{ number_format($sem_fee->getEnrolleeSumary($sem_fee->id, $enrollee->course_id, $sem_fee->name, $enrollee->id), 2) }}</td>
            @if ( $enrollee->mop_id == 1)
              <td>{{ $sem_fee->name == 'Tuition' ? $enrollee->getDiscount($enrollee->id)."%" : '' }}</td>
            @else
              <td></td>
            @endif
            @if ( $enrollee->mop_id == 1)
              <td id="discount">{{ $sem_fee->getTotalDiscount($enrollee->id, $sem_fee->id) }}</td>
            @else
              <td></td>
            @endif
            <td class="totalAmount">
              {{ number_format($sem_fee->getEnrolleeSummaryWithDiscount($sem_fee->id, $enrollee->course_id, $sem_fee->name, $enrollee->id), 2) }}
            </td>
          </tr>
        @endif
      @endforeach
      <tr>
        <td>Total</td>
        <td>{{ number_format($enrollee->getTotal($enrollee->id), 2) }}</td>
        <td></td>
        <td>{{  number_format($enrollee->getTotalDiscount($enrollee->id), 2) }}</td>
        <td>{{  number_format($enrollee->getTotalWithDiscount($enrollee->id), 2) }}</td>
      </tr>
      <tr>
        <td>Special Fee</td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ number_format($enrollee->getSpecialFee($enrollee->id) ,2) }}</td>
      </tr>
      <tr>
        <td style="font-weight: bold;" colspan="4">TOTAL TF, SF, & EF FOR FULL PAYMENT</td>
        <td  style="border-bottom: 3px double; font-weight: bold;">{{ number_format($enrollee->getOverallTotal($enrollee->id) ,2) }}</td>
      </tr>
    </tbody>
  </table>
</div>