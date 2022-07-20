@extends('backend.layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="container" style="height: 80vh">
        <div class="row d-flex mb-3">
            <div class="col-10">
                <h4>Subjects</h4>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <button class="btn btn-success text-white" type="button" onclick="document.getElementById('uploadForm').submit()">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Upload
                </button>
            </div>
        </div>
        <div class="row">
            <div class="card px-0">
                <div class="card-header">
                    Upload Subject
                </div>
                <div class="card-body">
                    <form action="{{ route('subject.upload') }}" method="POST" id="uploadForm"  enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload CSV or xlsx File<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection