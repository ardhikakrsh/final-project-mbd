@extends('GO.layouts.userAuth.auth')
@section('title', 'Owner Dashboard')

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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Order</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $sewas->count() }}
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
@endsection
