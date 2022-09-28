@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <div class="container">
    <x-page-header title="Search Student" buttonType="" buttonTitle="" routeName="" enrollee="0" />
    @if(session('hasbalance'))
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
          <div class="modal-status bg-danger"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>
            <h3>Enrollment Unsuccessfull!</h3>
            <div class="text-muted">This student has unpaid balance last semester</div>
          </div>
          <div class="modal-footer">
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                    Cancel
                  </a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container">
          <div class="row justify-content-center">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Students</h3>
              </div>
              <div class="card-body">
                <livewire:students-table/>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection