@extends('welcome')

@section('student')
  @if(session('success'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script>
      $(document).ready(function() {
        $('#modal-success').modal('show');
        console.log('suceess');
      });
    </script>
  @endif
  <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        <div class="modal-status bg-success"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg>
          <h3>{{ session('success') }}</h3>
            <div class="text-muted"></div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <a href="#" class="btn w-100">
                  Go to Fees
                </a>
              </div>
              <div class="col"><a href="#" class="btn btn-success w-100" data-bs-dismiss="modal">
                  Add
                </a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%; background-image: url({{ asset('images/white-background.jpg') }}); background-size: cover; background-position: start center;">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Choose mode of payment</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('student.mop', $enrollment_id) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label required">Mode of payment</label>
                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                  @foreach ($mop as $item)
                    <label class="form-selectgroup-item flex-fill">
                      <input type="radio" name="mode" value="{{ old('mode', $item->id) }}" class="form-selectgroup-input @error('mode') is-invalid @enderror">
                      <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                          <span class="form-selectgroup-check"></span>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <strong>{{ $item->mode }}</strong>
                          @if ($item->id == 1)
                            <p>You'll get a 5% discount if you proceed with Full Payment.</p>
                          @else
                            <p>You'll have to pay {{ number_format($downpayment->amount, 0) }} as downpayment for your chosen course.</p>
                          @endif
                        </div>
                      </div>
                    </label>
                  @endforeach
                </div> 
                @error('mode')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection