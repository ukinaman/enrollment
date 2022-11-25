<div class="modal modal-blur fade" id="modalDiscount" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Discounts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3 align-items-end">
          <form action="{{ route('stdDiscount.addDiscount', $enrollee) }}" method="POST" id="add-discount">
            @csrf
            <div class="col-md-6 col-xl-12">
              <div class="mb-3">
                <label class="form-label">Available Discounts</label>
                <div class="form-selectgroup">
                  @foreach ($discounts as $discount)
                    @if($discount->mop_id !== 1)
                      <label class="form-selectgroup-item"  data-bs-trigger="hover" data-bs-toggle="popover" title="{{ $discount->name }}" data-bs-content="And here's some amazing content. It's very engaging. Right?" data-bs-placement="top">
                        <input type="checkbox" name="discount[]" value="{{ intval($discount->percentage) }}" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">{{ $discount->name }}</span>
                      </label>
                    @else

                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="alert alert-success" role="alert">
          <h4 class="alert-title">Adding Discounts</h4>
          <div class="text-muted">Select the discount/s that is able to acquired by the student</div>
        </div>
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-title">Important!</h4>
          <div class="text-muted">Kindly double check the selected box/discount if it is intendedly selected or not</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('add-discount').submit()">Add Discount</button>
      </div>
    </div>
  </div>
</div>