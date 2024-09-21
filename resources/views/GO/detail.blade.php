@extends('GO.layouts.Home')
@section('title', 'Detail')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Order Detail</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow ratio ratio-1x1">
                    <img src="{{ asset('assets/img/vehicle-images/' . $kendaraan->foto) }}" alt="{{ $kendaraan->nama }}"
                        class="card-img">
                </div>
            </div>
            <!-- Card for Vehicle Details -->
            <div class="col-md-8 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Detail {{ $kendaraan->nama }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Nama Kendaraan</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->nama }}" readonly>
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Merk Kendaraan</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->merk }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Plat Nomor Kendaraan</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->plat }}" readonly>
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Tipe Kendaraan</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->tipeKendaraan->nama }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Warna Kendaraan</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->warna }}" readonly>
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Pemilik</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->pemilik->user->name }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Kondisi Kendaraan</strong></label>
                                <input type="text" class="form-control" value="{{ $kendaraan->kondisi }}" readonly>
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label"><strong>Harga</strong></label>
                                <input type="text" class="form-control"
                                    value="Rp{{ number_format($kendaraan->harga, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow mt-4">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Detail Pembayaran</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeOrder') }}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label"><strong>Nama Penyewa</strong></label>
                                <input type="text" name="nama_penyewa" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="tanggal_sewa" class="form-label"><strong>Tanggal Sewa</strong></label>
                                    <input type="date" class="form-control" name="tanggal_sewa" id="tanggal_sewa"
                                        aria-label="tanggal sewa" aria-describedby="tanggal sewa" value="{{ old('tanggal_sewa') }}" required>
                                    @error('tanggal_sewa')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_pengembalian" class="form-label"><strong>Tanggal Pengembalian</strong></label>
                                    <input type="date" class="form-control" name="tanggal_pengembalian" id="tanggal_pengembalian"
                                        aria-label="tanggal pengembalian" aria-describedby="tanggal pengembalian" value="{{ old('tanggal_pengembalian') }}" required>
                                    @error('tanggal_pengembalian')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="NIK" class="form-label"><strong>NIK</strong></label>
                                <input type="number" class="form-control" name="NIK" id="NIK"
                                    aria-label="NIK" aria-describedby="NIK" value="{{ old('NIK') ?? ($pelanggan->NIK ?? '') }}" required>
                                @error('NIK')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="nomor_telepon" class="form-label"><strong>Nomor Telepon</strong></label>
                                <input type="tel" class="form-control" name="nomor_telepon" id="nomor_telepon"
                                    aria-label="nomor_telepon" aria-describedby="nomor_telepon" value="{{ old('nomor_telepon') ?? ($pelanggan->nomor_telepon ?? '') }}" required>
                                @error('nomor_telepon')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="alamat" class="form-label"><strong>Alamat</strong></label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap" required>{{ old('alamat') ?? ($pelanggan->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="formatted_total_harga" class="form-label"><strong>Total Harga</strong></label>
                                <input type="text" class="form-control" name="formatted_total_harga" id="formatted_total_harga"
                                    aria-label="formatted_total_harga" aria-describedby="formatted_total_harga" value="{{ old('total_harga') !== null ? 'Rp' . number_format((float)old('total_harga'), 0, ',', '.') : 'Rp0' }}" readonly>
                                <input type="hidden" id="total_harga" name="total_harga" value="{{ old('total_harga') }}">
                                @error('formatted_total_harga')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

                            <div class="text-end mt-4">
                                <a href="/" class="btn bg-gradient-dark mr-4">Batal</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')
    <script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
    }

    document.getElementById('tanggal_pengembalian').addEventListener('change', function() {
        var tanggal_sewa = new Date(document.getElementById('tanggal_sewa').value);
        var tanggal_pengembalian = new Date(this.value);

        if (tanggal_pengembalian <= tanggal_sewa) {
            tanggal_pengembalian = new Date(tanggal_sewa.getTime() + (24 * 60 * 60 * 1000)); // Menambahkan satu hari
            this.value = tanggal_pengembalian.toISOString().split('T')[0];
        }

        var diffTime = Math.abs(tanggal_pengembalian - tanggal_sewa);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        var totalHargaPerHari = {{ $kendaraan->harga }};
        var totalHarga = diffDays * totalHargaPerHari;

        document.getElementById('formatted_total_harga').value = formatRupiah(totalHarga, 'Rp');
        document.getElementById('total_harga').value = totalHarga;
    });
</script>
@endpush
