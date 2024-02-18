@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                    <a href="{{ route('orders.pdf') }}" class="btn btn-primary">Download PDF</a>

                    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

                    @if ($orders->isEmpty())
                        <p>No orders found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Order Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->client->nama_client }}</td>
                                        <td>{{ $order->nama_item }}</td>
                                        <td>{{ $order->harga_item }}</td>
                                        <td>{{ $order->tanggal_order }}</td>
                                        <td>
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
