@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <x-page-header title="Discount" buttonType="add" buttonTitle="Discount" routeName="discount.create"  />
    
    <div class="page-body">
        <div class="container">
            <div class="row justify-content-center">
                <table class="table table-bordered">
                    <thead>
                        <th scope="row">Discount</th>
                        <th scope="row">Percentage</th>
                        <th scope="row">Actions</th>
                    </thead>
    
                    <tbody>
                        @foreach($discounts as $discount)
                            <tr>
                                <td>{{ $discount->name }}</td>
                                <td>{{ $discount->percentage."%" }}</td>
                                <td>
                                    <a href="{{ route('discount.edit', $discount->id) }}" class="btn btn-light">Edit</a>
                                    <a onclick="document.getElementById('discountDeleteForm{{ $discount->id }}').submit()" class="btn btn-danger text-white">Delete</a>
                                    <form action="{{ route('discount.delete', $discount->id) }}" method="POST" id="discountDeleteForm{{ $discount->id }}">@method('DELETE') @csrf</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection