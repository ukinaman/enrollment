@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <x-page-header title="Add User" buttonType="save" buttonTitle="" routeName="userform" enrollee="0"/>
  <div class="page-body">
    <div class="container">
      <div class="row justify-content-center">
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
        <form class="row g-3" action="{{ route('user.store') }}" method="POST" id="userform">
          @csrf
          <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Name</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="col-md-6">
              <label for="inputState" class="form-label">Role</label>
              <select id="inputState" class="form-select" name="roles">
                  @foreach ($roles as $role)
                      <option value="{{ $role }}">{{ $role }}</option>
                  @endforeach
              </select>
          </div>
          <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Password</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Confirm Password</label>
              <input id="confirm-password" type="password" class="form-control" name="confirm-password" required autocomplete="new-password">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

    