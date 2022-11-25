@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Subject" buttonType="save" buttonTitle="Subject" routeName="uploadForm" enrollee="0" />
        
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
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
            </div>
        </div>
    </div>
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
    
@endsection