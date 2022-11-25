@extends('backend.accounting.semestral-fee.show')

@section('semfee-table')
<div class="row mb-3">
  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-download">Print</button>
</div>
<div class="modal modal-blur fade" id="modal-download" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
      <div class="modal-status bg-success"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg>
        <h3>Download Assessment?</h3>
          <div class="text-muted mb-3">Do you want to download {{ Session::get('data')['course_name'].' '.Session::get('data')['year_name'].' '.'-'.' '.Session::get('data')['semester_name'] }} assessment?</div>
          <form action="{{ route('semfee.download', ['course' => $course, 'year' => $year, 'sem' => $sem]) }}" method="GET" id="downloadForm">
            @csrf
            <div class="mb-3">
              <label class="form-label">Add School Year</label>
              <input type="text" class="form-control" name="school_year" placeholder="2022-2023">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <a href="#" class="btn w-100" data-bs-dismiss="modal">
                Close
              </a>
            </div>
            <div class="col"><button class="btn btn-success w-100" onclick="document.getElementById('downloadForm').submit()">
                Download
              </button></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<h3 class="page-title my-3">ASSESSMENT</h2>
<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th>Fee</th>
          <th>Amount</th>
          <th>Action</th>
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
              <td>
                <a href="{{ route('semfee.edit', $fee->id) }}" class="mr-2">Edit</a>
                <a class="text-danger deleteFee" data-bs-toggle="modal" data-bs-target="#modal-danger" style="cursor: pointer" data-id="{{ $fee->id }}">Remove</a>
                <form action="{{ route('semfee.delete', $fee->id) }}" method="POST" id="deleteFeeForm{{ $fee->id }}">@method('delete')@csrf</form>
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
<hr>
<x-full-payment-sumarry course="{{ $course }}" year="{{ $year }}" sem="{{ $sem }}" />
<hr>
<x-down-payment-sumarry course="{{ $course }}" year="{{ $year }}" sem="{{ $sem }}" />

<div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>
        <h3>Are you sure?</h3>
        <div class="text-muted">Do you really want to remove this fee?</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                Cancel
              </a></div>
            <div class="col">
              <a class="btn btn-danger w-100" id="modalButton">
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    $('.deleteFee').each(function(){
      $(this).on("click", function(){
        var $id = $(this).data('id');
        $('#modalButton').on("click", function(){
          $("#deleteFeeForm"+$id+"").submit(); 
          console.log("#deleteFeeForm"+$id+"");
        })
        // console.log("#deleteFeeForm"+$(this).data('id')+"");
      })
    })
  });
</script>
@endsection