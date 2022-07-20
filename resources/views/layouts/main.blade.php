@extends('layouts.app')

@section('main')
    @include('layouts.sidebar')
    @include('layouts.header')
    @yield('main_container')
@endsection
