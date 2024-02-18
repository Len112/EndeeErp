@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Clients</div>

                <div class="card-body">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3" style="margin-bottom: 10px">Create New Client</a>

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($clients->isEmpty())
                        <p>No clients found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Client</th>
                                    <th>Alamat Client</th>
                                    <th>Tanggal Mulai Kontrak</th>
                                    <th>Tanggal Berakhir Kontrak</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->nama_client }}</td>
                                        <td>{{ $client->alamat_client }}</td>
                                        <td>{{ $client->tanggal_mulai_kontrak }}</td>
                                        <td>{{ $client->tanggal_berakhir_kontrak }}</td>
                                        <td>
                                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
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
