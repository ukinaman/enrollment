<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Base info</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="card-body">
                <div class="row flex-wrap">
                    <div class="col-md-3">
                        <div class="subheader">Name</div>
                        <p class="h3 mb-3">{{ $enrollment->student->full_name }}</p>
                    </div>
                    <div class="col-md-3">
                        <div class="subheader">Age</div>
                        <p class="h3 mb-3">{{ $enrollment->student->age }}</p>
                    </div>
                    <div class="col-md-3">
                        <div class="subheader">Gender</div>
                        <p class="h3 mb-3">{{ $enrollment->student->gender }}</p>
                    </div>
                    <div class="col-md-3">
                        <div class="subheader">Date of Birth</div>
                        <p class="h3 mb-3">{{ $enrollment->student->birthday }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="subheader">E-mail</div>
                        <div class="h3 mb-3">{{ $enrollment->student->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="subeader">Contact Number</div>
                        <div class="h3 mb-3">{{ $enrollment->student->contact_no }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="subheader">Course</div>
                        <div class="h3 mb-3">{{ $enrollment->getCourse($enrollment->course_id, 'full') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="subeader">Year</div>
                        <div class="h3 mb-3">{{ $enrollment->getYear($enrollment->year_id) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>