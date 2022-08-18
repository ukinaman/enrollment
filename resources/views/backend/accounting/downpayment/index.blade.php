@extends('backend.layouts.app')

@section('content')
  <div class="page-wrapper">
    <div class="container">
      <x-page-header title="Down Payment" buttonType="add" buttonTitle="" routeName="downpayment.create" enrollee="0" />
      <div class="page-body">
        <div class="container">
          <div class="card">
            <div class="table-responsive">
              <table class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th>Course</th>
                    <th>Down Payment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($downpayments as $downpayment)
                    <tr>
                      <td>{{ $downpayment->getCourse($downpayment->course_id) }}</td>
                      <td>{{ number_format($downpayment->amount, 2) }}</td>
                      <td>
                        <a href="{{ route('downpayment.edit', $downpayment->id) }}" class="mr-2">Edit</a>
                        <a class="text-danger deleteDownpayment" data-bs-toggle="modal" data-bs-target="#modal-danger" style="cursor: pointer" data-id="{{ $downpayment->id }}">Remove</a>
                        <form action="{{ route('downpayment.delete', $downpayment->id) }}" method="POST" id="deleteDownpaymentForm{{ $downpayment->id }}">@method('delete')@csrf</form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>
          <h3>Are you sure?</h3>
          <div class="text-muted">Do you really want to remove this down payment?</div>
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
      $('.deleteDownpayment').each(function(){
        $(this).on("click", function(){
          var $id = $(this).data('id');
          $('#modalButton').on("click", function(){
            $("#deleteDownpaymentForm"+$id+"").submit(); 
            console.log("#deleteDownpaymentForm"+$id+"");
          })
          // console.log("#deleteFeeForm"+$(this).data('id')+"");
        })
      })
    });
  </script>
@endsection