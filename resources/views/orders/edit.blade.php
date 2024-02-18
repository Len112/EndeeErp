@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Order</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="order_number">Order Number</label>
                            <input type="text" name="order_number" id="order_number" class="form-control"  value="{{ $order->order_number }}" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="client_id">Client</label>
                            <select name="client_id" id="client_id" class="form-control" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $client->id === $order->client_id ? 'selected' : '' }}>{{ $client->nama_client }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_item">Item Name</label>
                            <input type="text" name="nama_item" id="nama_item" class="form-control" value="{{ $order->nama_item }}" required>
                        </div>

                        <div class="form-group">
                            <label for="harga_item">Item Price</label>
                            <input type="number" name="harga_item" id="harga_item" class="form-control" value="{{ $order->harga_item }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_order">Order Date</label>
                            <input type="date" name="tanggal_order" id="tanggal_order" class="form-control" value="{{ $order->tanggal_order }}" required>
                        </div>
                        <div style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Update Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
