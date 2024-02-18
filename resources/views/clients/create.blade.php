@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Client</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clients.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama_client">Nama Client</label>
                            <input type="text" name="nama_client" id="nama_client" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat_client">Alamat Client</label>
                            <textarea name="alamat_client" id="alamat_client" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_mulai_kontrak">Tanggal Mulai Kontrak</label>
                            <input type="date" name="tanggal_mulai_kontrak" id="tanggal_mulai_kontrak" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_berakhir_kontrak">Tanggal Berakhir Kontrak</label>
                            <input type="date" name="tanggal_berakhir_kontrak" id="tanggal_berakhir_kontrak" class="form-control" required>
                        </div>
                        <div style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Create Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
