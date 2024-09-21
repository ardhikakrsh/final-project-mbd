@extends('GO.layouts.userAuth.auth')
@section('title', 'Kendaraan')
@section('content')
<form role="form text-left" method="POST" action="{{ route('owner.kendaraan.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-start">
        <div class="col-md-6 mb-4">
            <div class="card z-index-0 min-vh-150">
                <div class="card-header pb-4" style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 0%; background-position-x: 50%; ">
                </div>
                <div class="card-body">
                    <div class="card-header pb-2 pt-0 text-center">
                        <h4>Tambah Kendaraan Baru</h4>
                    </div>
                    <img src="{{ asset('assets/img/car.jpg') }}" class="card-img-top rounded-3 p-2" alt="vehicle">
                    <div class="mb-2 pt-2">
                        <label for="photo" class="form-label">Upload Foto Kendaraan</label>
                        <input type="file" class="form-control" name="foto" id="photo" accept="image/*" aria-label="Upload Foto Kendaraan">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card z-index-0 min-vh-150">
                <div class="card-body h-100">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Nama Kendaraan" name="nama" id="name" aria-label="Nama Kendaraan" aria-describedby="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Merek Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Merek Kendaraan" name="merk" id="brand" aria-label="Merek Kendaraan" aria-describedby="brand-addon" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Warna Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Warna Kendaraan" name="warna" id="color" aria-label="Warna Kendaraan" aria-describedby="color-addon" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label for="plate_number" class="form-label">Plat Nomor Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Plat Nomor Kendaraan" name="plat" id="plate_number" aria-label="Plat Nomor Kendaraan" aria-describedby="plate_number-addon" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Jenis Kendaraan</label>
                        <select class="form-select" name="tipe_kendaraan_id" id="role" required>
                            <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                            @foreach($roles as $roleName => $roleValue)
                            <option value="{{ $roleValue }}">{{ $roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="daily_rental_price" class="form-label">Harga Sewa Harian</label>
                        <div class="input-group">
                            <span class="input-group-text" id="price-addon">Rp</span>
                            <input type="number" class="form-control" placeholder="Masukkan Harga Sewa Harian" name="harga" id="daily_rental_price" aria-label="Harga Sewa Harian" aria-describedby="price-addon" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Kondisi Kendaraan</label>
                        <textarea class="form-control" placeholder="Deskripsi Kondisi Kendaraan" name="kondisi" id="description" aria-label="Deskripsi Kendaraan" aria-describedby="description-addon" maxlength="255" rows="4" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <a href="{{ route('owner.kendaraan.index') }}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
