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
                <div class="col-md-6" style="text-align: right">{{ $sem_fee->total($sem_fee->id, $course, $year, $sem) }}</div>
              </div>
            </th>
          </tr>
          @forelse ($sem_fee->fees as $fee)
            <tr>
              <td>{{ $fee->name }}</td>
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
                  <div class="col-md-6" style="text-align: right">{{ number_format($sem_fee->getOverallTotal($course, $year, $sem), 2) }}</div>
                </div>
              </th>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>