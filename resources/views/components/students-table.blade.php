<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Enrolles</h3>
    </div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-muted">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>
    <div class="card-table table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enrollments as $enrollment)
                    <tr>
                        <td class="w-1">
                            <span class="avatar avatar-sm">{{ $enrollment->student->initials }}</span>
                        </td>
                        <td>
                            {{ $enrollment->student->full_name }}
                        </td>
                        <td>
                            {{ $enrollment->getCourse($enrollment->course_id, 'full') }}
                        </td>
                        <td class="text-nowrap text-muted">
                            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
                            {{ $enrollment->enrolledDate($enrollment->student_id) }}
                        </td>
                        <td>
                            <div class="col">
                                <div class="text-truncate">
                                    By: Judah
                                </div>
                                <div class="text-muted">{{ $enrollment->updated_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('registrar.assessment.show', $enrollment->id) }}" class="btn btn-primary {{ $enrollment->assessed == 1 ? 'disabled' : '' }}" >
                                Assess
                            </a>
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing <span>{{ $enrollments->firstItem() }}</span> to <span>{{ $enrollments->lastItem() }}</span> of <span>{{ $enrollments->total() }}</span> entries</p>
        {{ $enrollments->links('vendor.pagination.custom') }}
    </div>
</div>