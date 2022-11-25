@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
  <x-page-header title="Roles" buttonType="add" buttonTitle="Role" routeName="roles.create" enrollee="0"  />
  
  <div class="page-body">
      <div class="container">
          @if($roles->isEmpty())
            <div class="row justify-content-center">
              <div class="row">
                  <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
                      <div class="d-flex align-items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                          Seems you have to add roles first
                      </div>
                  </div>
              </div>
            </div>
            @else
            <div class="card w-100">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Role</th>
                      <th>Guard</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $role)
                      <tr class="bg-light">
                        <td class="text-black">
                          {{ $role->name }}
                        </td>
                        <td class="text-black">
                          {{ $role->guard_name }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
      </div>
  </div>
</div>
@endsection