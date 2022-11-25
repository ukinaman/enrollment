@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
        <x-page-header title="Registered Users" buttonType="add" buttonTitle="User" routeName="user.create" enrollee="0"/>
        
        <div class="page-body">
            <div class="container">
                <div class="row justify-content-center">
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
                                        <span class="badge 
                                            @if ($role->name == "Registrar")
                                                bg-primary
                                            @elseif ($role->name == "Accounting")   
                                                bg-success
                                            @endif"
                                        >{{ $role->name }}</span>
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
    </div>
@endsection