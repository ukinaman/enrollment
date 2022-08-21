<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th>Fee</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sem_fees as $sem_fee)
          <tr class="bg-light">
            <th class="text-black" colspan="5">
              <div class="row d-flex justify-content-between">
                <div class="col-md-6">{{ $sem_fee->name }}</div>
                <div class="col-md-6" style="text-align: right">{{ $enrollment->enrolleeFeesAmount($sem_fee->id, $enrollment->id) }}</div>
              </div>
            </th>
          </tr>
          @forelse ($sem_fee->fees as $fee)
            <tr>
              <td>{{ $fee->name }} {{ $fee->sem_fee_id == 1 ? '('.$enrollment->getTotalUnits($enrollment->id).' units)' : '' }}</td>
              <td class="text-muted">
                {{ number_format($fee->amount, 2) }}
              </td>
            </tr>
          @empty
          @endforelse
          @if($loop->last)
            <tr class="bg-light">
              <th class="text-black" colspan="5">
                <div class="row d-flex justify-content-between">
                  <div class="col-md-6">Total</div>
                  <div class="col-md-6" style="text-align: right">{{ number_format($enrollment->enrolleeOverallTotal($enrollment->id), 2) }}</div>
                </div>
              </th>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>