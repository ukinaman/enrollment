@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($subjects as $subject)
            <div class="card px-0 mb-3">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Units</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($subject->subjects as $data)
                                <tr>
                                    <th>{{ $data->name }}</th>
                                    <th>{{ $data->units }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
                <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Seems you have to add courses first
                    </div>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary" type="button">Add Course</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection