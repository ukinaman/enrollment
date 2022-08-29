<form action="{{ route('stdDiscount.addDiscount', $enrollment->id) }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label required">Select Discount</label>
    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column mb-3">
      @foreach ($discounts as $discount)
        @if (!$enrollee_discounts->contains('discount_id', $discount->id))
          <label class="form-selectgroup-item flex-fill">
            <input type="checkbox" name="discount[]" value="{{ $discount->id }}" class="form-selectgroup-input @error('course') is-invalid @enderror">
            <div class="form-selectgroup-label d-flex align-items-center p-3">
              <div class="me-3">
                <span class="form-selectgroup-check"></span>
              </div>
              <div>
                <strong>{{ $discount->name }} {{ $discount->percentage.'%' }}</strong>
              </div>
            </div>
          </label>
        @endif
      @endforeach
    </div>
    <div class="container d-flex justify-content-end align-items-center gap-2">
      <button class="btn btn-success" type="submit">Add</button>
    </div>
  </div>
</form>

@if ($enrollee_discounts->count() != 0)
  <hr>
  <form action="{{ route('stdDiscount.deleteDiscount', $enrollment->id) }}" method="POST" id="stdDiscDel">
    @csrf
    @method('DELETE')
    <label class="form-label">Student Discounts</label>
    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column pb-2">
      @foreach ($enrollee_discounts as $discount)
        <label class="form-selectgroup-item flex-fill">
          <input type="checkbox" name="discount[]" value="{{ $discount->id }}" class="form-selectgroup-input @error('course') is-invalid @enderror">
          <div class="form-selectgroup-label d-flex align-items-center p-3">
            <div class="me-3">
              <span class="form-selectgroup-check"></span>
            </div>
            <div>
              <strong>{{ $discount->discount->name }} {{ $discount->discount->percentage.'%' }}</strong>
            </div>
          </div>
        </label>
      @endforeach
      <div class="container d-flex justify-content-end align-items-center gap-2">
        <button class="btn btn-danger" type="submit">Remove</button>
      </div>
    </div>
  </form>
@endif