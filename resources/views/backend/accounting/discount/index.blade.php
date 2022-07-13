@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-6">
                <h4>Discounts</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('discount.create') }}" class="btn btn-primary">Add</a>
            </div>
        </div>

        <div class="row">
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
@endsection