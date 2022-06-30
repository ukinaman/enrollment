<form action="{{ route('assessment.show') }}" method="GET" id="assessForm">
    <div class="row">
        <div class="col-md-4">
            <label for="inputState" class="form-label">Course</label>
            <select id="inputState" class="form-select @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}">
                <option selected>Choose...</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->accronym }}</option>
                @endforeach
            </select>
            @error('course')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Year</label>
            <select id="inputState" class="form-select @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}">
                <option selected>Choose...</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}">{{ $year->title }}</option>
                @endforeach
            </select>
            @error('year')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Semester</label>
            <select id="inputState" class="form-select @error('sem') is-invalid @enderror" name="sem" value="{{ old('sem') }}">
                <option selected>Choose...</option>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->title }}</option>
                @endforeach
            </select>
            @error('sem')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</form>