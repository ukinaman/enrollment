<div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Large modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn me-auto" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('accounting.reciept.download', $paymentId) }}" class="btn btn-primary">Print</a>
      </div>
    </div>
  </div>
</div>