@extends('backend.registrar.subject.index')

@section('show-subjects')
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Subject</th>
                <th scope="col">Units</th>
                <th scope="col">Lab</th>
            </tr> 
        </thead>
        <tbody class="table-group-divider">
            @foreach ($subjects as $subject)
                <tr>
                    <th>{{ $subject->code }}</th>
                    <th>{{ $subject->name }}</th>
                    <th>{{ $subject->units }}</th>
                    <th>{{ $subject->lab }}</th>
                </tr>
            @endforeach
            <tr>
                <th></th>
                <th><strong>Total</strong></th>
                <th><strong>{{ $subjects->sum('units') }}</strong></th>
                <th><strong>{{ $subjects->sum('lab') }}</strong></th>
            </tr>
        </tbody>
    </table>
</div>
@endsection