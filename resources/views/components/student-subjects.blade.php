<div class="card mb-3">
    @if ($user == 'Registrar')
      <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Subjects</h3>
        <button class="btn btn-success" onclick="document.getElementById('assessSubjects').submit()">Assess</button>
      </div>
    @endif
    <div class="card-body border-bottom py-3">
        <div class="d-flex justify-content-between">
            <div class="col-md-6">
                <div>
                    <div class="subheader">Semester</div>
                    <p class="h3">{{ $enrollment->getSemester($enrollment->sem_id) }}</p>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-end">
                <div class="subheader">Total units</div>
                <p class="h3" id="total"> {{ $course->totalUnitsOfEnrollee($enrollment->id) }}</p> 
            </div>
        </div>
        <div class="row">
            <p class="text-muted"><span class="text-danger">*</span> Check the subjects that is unable to take by the student.</p>
        </div>
    </div>
    <div class="card-table table-responsive">
        <form action="{{ route('registrar.assessment.store', $enrollment->id) }}" method="POST" id="assessSubjects">
            @csrf
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        @if ($user == 'Registrar')
                          <th>
                            <input type="checkbox" id="checkAll" data-bs-trigger="hover" data-bs-toggle="popover" title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">
                          </th>
                        @endif
                        <th>Subejct Code</th>
                        <th>Title</th>
                        <th id="units">Units</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrollment->getSubjects($enrollment->id) as $subject)
                        <tr>
                            @if ($user == 'Registrar')
                              <td>
                                  <input type="checkbox" name="unabled_subject[]" value="{{ $subject->id }}" class="check-subject" data-bs-toggle="tooltip" data-bs-placement="right" title="Exclude subject">
                              </td>
                            @endif
                            <td>
                                {{ $subject->code }}
                            </td>
                            <td>
                                {{ $subject->name }}
                            </td>
                            <td class="sum">
                                {{ $subject->units }}
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>
</div>