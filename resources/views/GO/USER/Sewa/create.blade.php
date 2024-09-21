@extends('GO.layouts.userAuth.auth')
@section('title', 'Pembayaran Sewa')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-4">
                    <h3 class="font-weight-bold mb-0">Pembayaran Sewa {{ $sewa->kendaraan->nama }} oleh
                        {{ $sewa->pelanggan->user->name }}</h3>
                </div>

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Informasi Pembayaran</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="text-sm font-weight-bold border">Tanggal Sewa</td>
                                        <td class="border">{{ $sewa->tanggal_sewa }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold border">Tanggal Pengembalian</td>
                                        <td class="border">{{ $sewa->tanggal_pengembalian }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold border">Durasi Sewa</td>
                                        <td class="border">{{ $sewa->durasi_sewa }} hari</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold border">Total Harga</td>
                                        <td class="border">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="mt-4">
                            <form action="{{ route('user.order.payment', ['id' => $sewa->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h5 class="font-weight-bold mb-3">Detail Pembayaran</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                        <input type="text" class="form-control" name="metode_pembayaran"
                                            id="metode_pembayaran" aria-label="Metode Pembayaran"
                                            aria-describedby="Metode Pembayaran" value="{{ old('metode_pembayaran') }}"
                                            required>
                                        @error('metode_pembayaran')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="detail_pembayaran" class="form-label">Detail Pembayaran</label>
                                        <select class="choices form-select @error('detail_pembayaran') is-invalid @enderror"
                                            name="detail_pembayaran" id="detail_pembayaran" required>
                                            <option value="" disabled selected>Select Type Pembayaran</option>
                                            <option value="lunas" @if (old('detail_pembayaran') == 'lunas') selected @endif>Lunas
                                            </option>
                                            <option value="dp" @if (old('detail_pembayaran') == 'dp') selected @endif>DP
                                            </option>
                                            <option value="denda" @if (old('detail_pembayaran') == 'denda') selected @endif>Denda
                                            </option>
                                        </select>
                                        @error('detail_pembayaran')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="jumlah_pembayaran" class="form-label">Jumlah Bayar (Rp)</label>
                                        <input type="number" class="form-control" name="jumlah_pembayaran"
                                            id="jumlah_pembayaran" aria-label="Jumlah Pembayaran"
                                            aria-describedby="Jumlah Pembayaran" value="{{ old('metode_pembayaran') }}"
                                            required>
                                        @error('jumlah_pembayaran')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                                        <input type="file" class="form-control" name="bukti_pembayaran"
                                            id="bukti_pembayaran" aria-label="Bukti Pembayaran"
                                            aria-describedby="Bukti Pembayaran" value="{{ old('bukti_pembayaran') }}"
                                            required>
                                        @error('bukti_pembayaran')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="sewa_id" value="{{ $sewa->id }}">
                                <div class="text-end mt-4">
                                    <a href="{{ route('user.order.index') }}" class="btn bg-gradient-dark mr-4">Batal</a>
                                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
