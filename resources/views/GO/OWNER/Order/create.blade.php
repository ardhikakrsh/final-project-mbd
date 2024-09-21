@extends('GO.layouts.userAuth.auth')
@section('title', 'Order')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header pb-2  text-center bg-gradient-primary">
                    <h5 class="text-white">Create new Sewa</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="{{ route('owner.order.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="kendaraan_id">Select Kendaraan</label>
                            <select class="choices form-select @error('kendaraan_id') is-invalid @enderror"
                                    name="kendaraan_id" id="kendaraan_id" required>
                                @if(!old('kendaraan_id'))
                                    <option value="" disabled selected>Select Kendaraan</option>
                                @endif
                                @foreach($kendaraans as $kendaraan)
                                    @if(old('kendaraan_id') == $kendaraan->id)
                                        <option value="{{$kendaraan->id}}" selected>{{$kendaraan->nama ."(". $kendaraan->plat .")"." milik ". $kendaraan->pemilik->user->name}}</option>
                                    @else
                                        <option value="{{$kendaraan->id}}">{{$kendaraan->nama ." (". $kendaraan->plat .")"." milik ". $kendaraan->pemilik->user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kendaraan_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="tanggal_sewa">Tanggal Sewa</label>
                            <input type="date" id="tanggal_sewa"
                                    class="form-control  @error('tanggal_sewa') is-invalid @enderror"
                                    name="tanggal_sewa" value="{{old('tanggal_sewa')}}" required>
                            @error('tanggal_sewa')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="tanggal_perkiraan_kembali">Tanggal Akhir Sewa</label>
                            <input type="date" id="tanggal_perkiraan_kembali"
                                    class="form-control round @error('tanggal_perkiraan_kembali') is-invalid @enderror"
                                    name="tanggal_perkiraan_kembali" value="{{old('tanggal_perkiraan_kembali')}}" required>
                            @error('tanggal_perkiraan_kembali')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-group">
                            <label for="users_id">Select Penyewa</label>
                            <select class="choices form-select @error('users_id') is-invalid @enderror"
                                    name="users_id" id="users_id" required>
                                @if(!old('users_id'))
                                    <option value="" disabled selected>Select Penyewa</option>
                                @endif
                                @foreach($users as $user)
                                    @if(old('users_id') == $user->id)
                                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                    @else
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('users_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.orders.index')}}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
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
