@extends('backend.layouts.app')

@section('content')
    <div class="container" style="height: 80vh">
        <div class="row justify-content-center">
            <div class="container d-flex justify-content-between align-items-center my-4">
                <h3>Registered Users</h3>
                <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                            <tr>No users yet</tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection