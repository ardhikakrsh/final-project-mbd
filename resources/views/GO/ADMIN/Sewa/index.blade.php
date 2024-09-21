@extends('GO.layouts.userAuth.auth')
@section('title', 'Order')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Orders</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $countOrder['totalOrder'] }}
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Order selesai</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $countOrder['totalSelesai'] }}
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
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Orders</h5>
                        </div>
                        <a href="{{ route('admin.orders.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                            type="button">+&nbsp; New order</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NO
                                    </th>
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
                                        Tanggal Pengembalian
                                    </th>                                    
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Lama Sewa
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
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                        </td>
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->tanggal_pengembalian }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->durasi_sewa }} hari</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sewa->formatHarga() }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p @class([
                                                'text-xs font-weight-bold mb-0 p-1 rounded',
                                                'bg-gradient-success text-white' => $sewa->status_sewa == 'diterima',
                                                'bg-gradient-danger text-white' => $sewa->status_sewa == 'ditolak',
                                                'bg-gradient-light text-black' => $sewa->status_sewa == 'menunggu',
                                                'bg-gradient-secondary text-white' => $sewa->status_sewa == 'selesai',
                                            ])>{{ $sewa->status_sewa }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.orders.show', $sewa->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="View order">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.orders.edit', $sewa->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="Edit order">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.orders.destroy', $sewa->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-confirm-delete="true"
                                                data-bs-original-title="Delete order">
                                                <i class="fas fa-trash text-secondary"></i>
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
