@extends('GO.layouts.userAuth.auth')
@section('title', 'Admin Dashboard')
@section('content')

    <div class="row">
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card bg-gradient-primary">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column h-100 text-white">
                              <h5 class="pt-2 text-center font-weight-bolder text-white">Total Revenue</h5>
                              <p class="mb-1 text-center  text-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                                <p class="mb-0">Kamu harus mengeluarkan uang untuk menghasilkan uang. </p>
                                <p class="mb-3 text-center">- Titus Maccius Plautus </p>
                                <a class="text-body  text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                    href="{{route('admin.pembayarans.index')}}">
                                    <span class="text-white">Detail Revenue
                                      <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row col-9">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kendaraan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ \App\Models\Kendaraan::all()->count() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pelanggan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ \App\Models\Pelanggan::all()->count() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Owner</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ \App\Models\Pelanggan::all()->count() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-dark">
                    <div class="card-body p-3">
                        
                                <div class="numbers">
                                    <p class="text-md mb-0 font-weight-bold text-white text-center">Tetap semangat dan percayalah bahwa setiap langkah adalah bagian dari perjalanan menuju kesuksesan. Bersama GO-RENT, kita bisa mengatasi setiap tantangan dan meraih impian dengan penuh keyakinan dan semangat!</p>
                                        
                                
                        </div>
                    </div>
                </div>
            </div>           
        </div>
        
        
    </div>
    <div class="row mt-4">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Pembayaran yang perlu dicek</h5>
                        </div>
                        <a href="{{ route('admin.pembayarans.index') }}" class="btn bg-gradient-primary btn-sm mb-0"
                            type="button">Details Pembayarans</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Metode Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Detail Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah Bayar (Rp)
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $pembayaran->metode_pembayaran }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $pembayaran->detail_pembayaran }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                Rp {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <p @class([
                                                'text-xs font-weight-bold mb-0 p-1 rounded',
                                                'bg-gradient-success text-white' =>
                                                    $pembayaran->status_pembayaran == 'diterima',
                                                'bg-gradient-danger text-white' =>
                                                    $pembayaran->status_pembayaran == 'ditolak',
                                                'bg-gradient-light text-black' =>
                                                    $pembayaran->status_pembayaran == 'menunggu',
                                                'bg-gradient-warning text-white' =>
                                                    $pembayaran->status_pembayaran == 'revisi',
                                            ])>{{ $pembayaran->status_pembayaran }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.pembayarans.show', $pembayaran->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="View pembayaran">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pembayaran Selesai</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ \App\Models\Pembayaran::where('status_pembayaran','diterima')->count() }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pembayaran Ditolak</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ \App\Models\Pembayaran::where('status_pembayaran','ditolak')->count() }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pembayaran Check</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $pembayarans->count() }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Orders yang perlu dicek</h5>
                        </div>
                        <a href="{{ route('admin.orders.index') }}" class="btn bg-gradient-primary btn-sm mb-0"
                            type="button">Details Orders</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Penyewa
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Kendaraan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Sewa
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Harga
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sewas as $sewa)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->pelanggan->user->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->kendaraan->nama }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->tanggal_sewa }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->durasi_sewa }} hari</p>
                                        </td>
                                        <td class="text-center">
                                            <p @class([
                                                'text-xs font-weight-bold mb-0 p-1 rounded',
                                                'bg-gradient-success text-white' => $sewa->status_sewa == 'diterima',
                                                'bg-gradient-danger text-white' => $sewa->status_sewa == 'ditolak',
                                                'bg-gradient-light text-black' => $sewa->status_sewa == 'menunggu',
                                            ])>{{ $sewa->status_sewa }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.orders.index', $sewa->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="View order">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
