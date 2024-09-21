@extends('GO.layouts.userAuth.auth')
@section('title', 'Order')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center bg-gradient-primary">
                    <h5 class="text-white m-0">Edit Order</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="post" action="{{ route('admin.orders.update',$order->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Penyewa</label>
                            <input type="text" class="form-control" placeholder="Penyewa" name="name" id="name"
                                aria-label="Penyewa" aria-describedby="name" value="{{ old('name', $order->pelanggan->user->name) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control" placeholder="Nama Kendaraan" name="nama" id="nama"
                                aria-label="Nama Kendaraan" aria-describedby="nama" value="{{ old('nama', $order->kendaraan->nama) }}" textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_sewa" class="form-label"><strong>Tanggal Sewa</strong></label>
                            <input type="date" class="form-control" name="tanggal_sewa" id="tanggal_sewa"
                                aria-label="Tanggal Sewa" aria-describedby="Tanggal Sewa" value="{{ old('tanggal_sewa', $order->tanggal_sewa) }}" required>
                            @error('tanggal_sewa')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label"><strong>Tanggal Pengembalian</strong></label>
                            <input type="date" class="form-control" name="tanggal_pengembalian" id="tanggal_pengembalian"
                                aria-label="tanggal pengembalian" aria-describedby="tanggal pengembalian" value="{{ old('tanggal_pengembalian', $order->tanggal_pengembalian) }}" required>
                            @error('tanggal_pengembalian')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                         </div>                                            
                        <div class="mb-3">
                           <label for="total_harga" class="form-label">Total Harga</label>
                           <input type="total_harga" class="form-control" placeholder="Total Harga (Rp)" name="total_harga" id="total_harga"
                               aria-label="Total Harga" aria-describedby="Total Harga" value="{{old('total_harga',$order->total_harga)}}" textarea>
                       </div>
                       <div class="mb-3">
                        <label for="status_sewa" class="form-label">Status Sewa</label>
                        <select class="choices form-select"
                            name="status_sewa" id="status_sewa" required>
                            <option value="" disabled selected>Select Status Sewa</option>
                            @foreach ($status as $item)
                                <option value="{{ $item }}"  @if (old('status_sewa', $order->status_sewa) == $item ) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('status_sewa')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        </div>       
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.orders.index')}}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

