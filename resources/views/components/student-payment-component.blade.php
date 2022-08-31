<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h2>Balance</h2>
    <div class="col-2 d-flex flex-column align-items-end">
      <h3>{{ number_format($enrollee->getBalance($enrollee->id), 2) }}</h3>
      @if (!$enrollee->isFullOfPayment($enrollee->mop_id) && !$enrollee->isPaid($enrollee->id))
        <div class="page-pretitle">(Downpayment included)</div>
      @endif
    </div>
  </div>
  <div class="list-group list-group-flush list-group-hoverable">
    @forelse ($student_payments as $payment)
      <div class="list-group-item">
        <div class="row align-items-center">
          <div class="col-auto"><span class="badge {{ $payment->isLatestPayment($enrollee->id, $payment->id) ? 'bg-red' : 'bg-white'  }}"></span></div>
          <div class="col-auto">
            <a href="#">
              <span class="avatar bg-blue-lt" style="background-image: url(./static/avatars/000m.jpg); font-size: 10px;">{{ $payment->payment_method }}</span>
            </a>
          </div>
          <div class="col text-truncate">
            <strong><a href="#" class="text-reset d-block">{{ $payment->term }}</a></strong>
            <div class="d-block text-muted text-truncate mt-n1">{{ "Amount: ".number_format($payment->amount, 2) }}</div>
          </div>
          <div class="col-auto">
            <h3>{{ "No.".$payment->paymentORnumber($payment->id) }}</h3>
            <div class="page-pretitle">{{ $payment->created_at }}</div>
          </div>
        </div>
      </div>
    @empty
      <div class="d-flex flex-column justify-content-center align-items-center gap-1">
        <img src="{{ asset('images/empty.svg') }}" alt="empty state" height="300" width="300">
        <p class="text-center">No payment made yet</p>
      </div>
    @endforelse
  </div>
  <div class="card-footer d-flex justify-content-end">
    @if ($enrollee->getBalance($enrollee->id) != 0)
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-team">Pay</button>
    @else
      <p>Paid</p>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <circle cx="12" cy="12" r="9" />
        <path d="M9 12l2 2l4 -4" />
      </svg>
    @endif
  </div>
</div>

<div class="modal modal-blur fade" id="modal-team" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pay</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearInput()"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 d-flex justify-content-between">
          <div class="col-10">
            <div class="page-pretitle">Name</div>
            <h4>{{ $enrollee->getFullName($enrollee->id, 1) }}</h4>
          </div>
          <div class="col-2">
            <div class="page-pretitle">Course</div>
            <h4>{{ $enrollee->getCourse($enrollee->course_id, 'acc') }}</h4>
          </div>
        </div>
        <div class="mb-3 d-flex justify-content-between">
          <div class="col-10">
            <div class="page-pretitle">Mode of Payment</div>
            <h4>{{ $enrollee->getMop() }}</h4>
          </div>
          <div class="col-2">
            <div class="page-pretitle">Balance</div>
            <h4>{{ number_format($enrollee->getBalance($enrollee->id), 2) }}</h4>
          </div>
        </div>
        @if (!$enrollee->isFullOfPayment($enrollee->mop_id))
          <div class="mb-3 d-flex justify-content-between">
            <div class="col-10">
              <div class="page-pretitle">Downpayment Amount</div>
              <h4 id="downpayment" data-isdownpayment="true" data-downpayment="{{ $enrollee->getEnrolleeTotalDownpayment($enrollee->id) }}">{{ number_format($enrollee->getEnrolleeTotalDownpayment($enrollee->id), 2) }}</h4>
            </div>
          </div>
        @endif
        <h3 class="mb-3">{{ "No.".$enrollee->getORNumber() }}</h3>
        <form action="{{ route('payment.pay', $enrollee->id) }}" method="post" id="paymentform">
          @csrf
          <div class="mb-3">
            <div class="form-label">Term</div>
            <select class="form-select" name="term" id="termSelect">
              @if ($enrollee->mop_id == 1)
                <option value="Fullpayment" selected>Fullpayment</option>
              @elseif(!$enrollee->downpaymentIsPaid($enrollee->id))
                <option value="Downpayment">Downpayment</option>
              @else
                <option selected>Choose ...</option>
                <option value="Term 1">Term 1</option>
                <option value="Term 2">Term 2</option>
                <option value="Term 3">Term 3</option>
              @endif
            </select>
          </div>
          <div class="mb-3">
            <div class="form-label">Payment Method</div>
            <select class="form-select" name="payment_method">
              <option selected>Choose ...</option>
              <option value="Cash">Cash</option>
              <option value="Gcash">Gcash</option>
              <option value="Paymaya">Paymaya</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="any" class="form-control" name="amount" onkeyup="validate({{ $enrollee->enrolleeOverallTotalWithDiscount($enrollee->id) }}, this.value)" id="amountInput" placeholder="Input Amount">
            <div class="invalid-feedback">Insufficient Amount</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal" onclick="clearInput()">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="document.getElementById('paymentform').submit()">Pay</button>
      </div>
    </div>
  </div>
</div>

<script>
  var amount = "{{ $enrollee->enrolleeOverallTotalWithDiscount($enrollee->id) }}"
  
  function validate(amount, value)
  {
    const amountInput = document.querySelector('#amountInput');
    const termSelect = document.querySelector('#termSelect');
    const downpayment = document.querySelector('#downpayment');

    if(termSelect.value == "Downpayment" || termSelect.value == "Fullpayment") {
      if(parseFloat(value) == parseFloat(amount) || parseFloat(value) == parseFloat(downpayment.dataset.downpayment )){
        amountInput.classList.remove('is-invalid')
        amountInput.classList.add('is-valid')
      } else if (parseFloat(value) != parseFloat(amount) || parseFloat(value) != parseFloat(downpayment.dataset.downpayment )){
        amountInput.classList.remove('is-valid')
        amountInput.classList.add('is-invalid')
      } else {
        amountInput.classList.remove('is-valid')
        amountInput.classList.remove('is-invalid')
      }
    }
  }

  function clearInput(){
    document.querySelector('#amountInput').value = ""
  }
</script>