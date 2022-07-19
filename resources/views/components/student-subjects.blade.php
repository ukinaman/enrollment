<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Subjects</h3>
    </div>
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
                <p class="h3" id="total"> {{ $course->totalUnits($enrollment->year_id, $enrollment->sem_id) }}</p> 
            </div>
        </div>
        <div class="row">
            <p class="text-muted"><span class="text-danger">*</span> Check the subjects that is unable to take by the student.</p>
        </div>
    </div>
    <div class="card-table table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th>Subejct Code</th>
                    <th>Title</th>
                    <th id="units">Units</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($course->getSubjects($enrollment->year_id, $enrollment->sem_id) as $subject)
                    <tr>
                        <td>
                            <input type="checkbox" class="check-subject">
                        </td>
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
    </div>
</div>