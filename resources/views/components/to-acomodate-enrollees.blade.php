<div class="card" style="height: 28rem">
    <div class="card-header">
        <h3 class="card-title">Pending enrollees</h3>
    </div>
    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
        <div class="divide-y">
            @forelse ($enrollees as $enrollee)
                <div data-bs-toggle="tooltip" data-bs-placement="right" title="Assess">
                    <a href="{{ route('registrar.assessment.show', $enrollee->id) }}" style="color: inherit; text-decoration: inherit;">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar">{{ $enrollee->student->initials }}</span>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>{{ $enrollee->student->full_name }}</strong> enroll in <strong>{{ $enrollee->getCourse($enrollee->course_id, 'acc') }}</strong> {{ $enrollee->student->current_year($enrollee->year_id).' '.$enrollee->student->current_sem($enrollee->sem_id) }}.
                                </div>
                                <div class="text-muted">{{ $enrollee->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="badge bg-primary"></div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>
</div>