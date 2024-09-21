@extends('GO.layouts.userAuth.auth')
@section('title', 'Kendaraan')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header pb-2  text-center">
                    <h5>Create New Kendaraan</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="post" action="{{ route('admin.kendaraans.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control" placeholder="Name" name="nama" id="nama"
                                aria-label="Name" aria-describedby="name" value="{{old('nama')}}" required>
                                @error('nama')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" class="form-control" placeholder="Merk" name="merk" id="merk"
                                aria-label="Merk" aria-describedby="merk" value="{{old('merk')}}" required>
                                @error('merk')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipe_kendaraan_id" class="form-label">Tipe Kendaraan</label>
                            <select class="form-select" name="tipe_kendaraan_id" id="role" required>
                                <option value="" disabled selected>Pilih Tipe Kendaraan</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" @if (old('tipe_kendaraan_id') == $type->id) selected @endif>{{ $type->nama }}</option>
                                    
                                @endforeach
                            </select>
                            @error('tipe_kendaraan_id')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="plat" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" placeholder="Merk" name="plat" id="plat"
                                aria-label="Plat Nomor" aria-describedby="Plat Nomor" value="{{old('plat')}}" required>
                                @error('plat')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna Kendaraan</label>
                            <input type="text" class="form-control" placeholder="Warna Kendaraan" name="warna" id="warna"
                                aria-label="Warna Kendaraan" aria-describedby="Warna Kendaraan" value="{{old('warna')}}" required>
                                @error('warna')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Sewa Harian</label>
                            <div class="input-group">
                                <span class="input-group-text" id="price-addon">Rp</span>
                                <input type="number" class="form-control" placeholder="Masukkan Harga Sewa Harian" name="harga" id="harga" aria-label="Harga Sewa" aria-describedby="price-addon" min="0" required value="{{old('harga')}}">
                            </div>
                            @error('kondisi')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi Kendaraan</label>
                            <textarea class="form-control" placeholder="Kondisi Kendaraan" name="kondisi" id="kondisi"
                                      aria-label="Kondisi Kendaraan" aria-describedby="kondisi" required>{{ old('kondisi') }}</textarea>
                            @error('kondisi')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        
                        <div class="mb-3">
                            <label for="pemilik_id" class="form-label">Pemilik Kendaraan</label>
                            <select class="form-select" name="pemilik_id" id="pemilik_id" required>
                                <option value="" disabled selected>Pilih Pemilik Kendaraan</option>
                                @foreach($pemiliks as $pemilik)
                                <option value="{{ $pemilik->id }}" @if (old('pemilik_id') == $pemilik->id) selected @endif>{{ $pemilik->user->name }}</option>
                                @endforeach
                            </select>
                            @error('tipe_kendaraan_id')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto kendaraan</label>
                                <input type="file" class="form-control" name="foto"
                                id="foto" aria-label="Foto kendaraan"
                                aria-describedby="Foto kendaraan" value="{{ old('foto') }}"
                                required>
                            @error('foto')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.kendaraans.index')}}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
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
