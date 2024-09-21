@extends('GO.layouts.userAuth.auth')
@section('title', 'Pembayaran')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center bg-gradient-primary">
                    <h5 class="m-0 text-white">Create new Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="{{ route('admin.pembayarans.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="sewa_id" class="form-label">Selec Vehicles for Payment</label>
                            <select class="choices form-select"
                                name="sewa_id" id="sewa_id" required>
                                <option value="" disabled selected>Select Vehicles</option>
                                @foreach ($sewas as $sewa)
                                    <option value="{{ $sewa->id }}"  @if (old('sewa_id') == $sewa->id ) selected @endif>{{ $sewa->kendaraan->nama}}</option>
                                @endforeach
                            </select>
                            @error('sewa_id')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <input type="metode_pembayaran" class="form-control" placeholder="Metode Pembayaran" name="metode_pembayaran" id="metode_pembayaran"
                                aria-label="Metode Pembayaran" aria-describedby="Metode Pembayaran" value="{{ old('metode_pembayaran') }}" required>
                            @error('metode_pembayaran')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_pembayaran" class="form-label">Jumlah Bayar (Rp)</label>
                            <input type="number" class="form-control" placeholder="0" name="jumlah_pembayaran"
                                id="jumlah_pembayaran" aria-label="Jumlah Pembayaran"
                                aria-describedby="Jumlah Pembayaran" value="{{ old('jumlah_pembayaran') }}"
                                required>
                            @error('jumlah_pembayaran')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="detail_pembayaran" class="form-label">Detail Pembayaran</label>
                            <select class="choices form-select" name="detail_pembayaran" id="detail_pembayaran" required>
                                <option value="" disabled selected>Select Type Pembayaran</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}"  @if (old('detail_pembayaran') == $type ) selected @endif>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('detail_pembayaran')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="bukti_pembayaran"
                                id="bukti_pembayaran" aria-label="Bukti Pembayaran"
                                aria-describedby="Bukti Pembayaran" value="{{ old('bukti_pembayaran') }}"
                                required>
                            @error('bukti_pembayaran')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select class="choices form-select"
                                name="status_pembayaran" id="status_pembayaran" required>
                                <option value="" disabled selected>Select Status Pembayaran</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item }}"  @if (old('status_pembayaran') == $item ) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('status_pembayaran')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.pembayarans.index') }}"
                                    class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
