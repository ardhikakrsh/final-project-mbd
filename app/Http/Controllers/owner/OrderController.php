<?php

namespace App\Http\Controllers\owner;

use App\Enums\RolesType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Kendaraan;
use App\Models\Pemilik;
use App\Models\Sewa;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemilik = Pemilik::where('users_id', Auth::id())->first();
        $kendaraans = Kendaraan::where('pemilik_id', $pemilik->id)->get();
        $sewas = Sewa::whereIn('kendaraan_id', $kendaraans->pluck('id'))->get();
        foreach ($sewas as $sewa) {
            $sewa->durasi_sewa = $this->cekDurasi($sewa->id);
        }
        return view('GO.OWNER.Order.index',compact('sewas'));
    }
    public function cekDurasi($id)
    {
        $result = DB::select('SELECT cekDurasi(?) as durasi_sewa', [$id]);
        return $result[0]->durasi_sewa;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemilik = Pemilik::where('users_id', Auth::id())->first();
        $kendaraans = Kendaraan::where('pemilik_id', $pemilik->id)->get();
        $users = User::where('role', RolesType::USER)->get();

        return view('GO.OWNER.Order.create', compact('kendaraans', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_perkiraan_kembali' => 'required|date',
            'users_id' => 'required|exists:users,id',
        ]);

        $sewa = Sewa::where('kendaraan_id', $data['kendaraan_id'])
        ->where(function ($query) use ($data) {
            $query->whereBetween('tanggal_sewa', [$data['tanggal_sewa'], $data['tanggal_perkiraan_kembali']])
            ->orWhereBetween('tanggal_pengembalian', [$data['tanggal_sewa'], $data['tanggal_perkiraan_kembali']]);
        })->first();

        if ($sewa) {
            return redirect()->back()->withErrors(['errors' => 'The vehicle is already rented on the specified date']);
        }

        $lama_sewa = strtotime($data['tanggal_perkiraan_kembali']) - strtotime($data['tanggal_sewa']);
        $lama_sewa = $lama_sewa / (60 * 60 * 24);
        $harga = Kendaraan::findOrFail($data['kendaraan_id'])->harga;
        $data['total_harga'] = $lama_sewa * $harga;
        $pelanggan_id = User::findOrFail($data['users_id'])->pelanggan->id;

        DB::beginTransaction();

        try {
            Sewa::create([
                'kendaraan_id' => $data['kendaraan_id'],
                'tanggal_sewa' => $data['tanggal_sewa'],
                'tanggal_pengembalian' => $data['tanggal_perkiraan_kembali'],
                'total_harga' => $data['total_harga'],
                'status sewa' => "menunggu",
                'pelanggan_id' => $pelanggan_id,
            ]);
            DB::commit();
            return redirect(route('owner.order.index'))->with('success', 'Sewa successfully created');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sewa $order)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sewa $order)
    {
        $order->durasi_sewa = $this->cekDurasi($order->id);
        return view('GO.OWNER.Order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
