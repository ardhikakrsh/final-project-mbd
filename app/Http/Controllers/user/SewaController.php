<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Sewa;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enums\StatusPembayaranType;
use App\Enums\TipePembayaranType;
use App\Models\Pembayaran;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $pelangganID = Pelanggan::where('users_id', $userId)->first()->id;
        $sewas = Sewa::where('pelanggan_id', $pelangganID)->get();
        foreach ($sewas as $sewa) {
            $sewa->durasi_sewa = $this->cekDurasi($sewa->id);
        }
        return view('GO.USER.Sewa.index', compact('sewas'));


        // $sewas = Sewa::all();
        // $kendaraans = Kendaraan::all();
        // return view('GO.USER.Sewa.index', compact('sewas', 'kendaraans'));
    }

    public function cekDurasi($id){
        $result = DB::select('SELECT cekDurasi(?) as durasi_sewa', [$id]);
        return $result[0]->durasi_sewa;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('GO.USER.Sewa.create', compact('sewa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sewa_id' => 'required|exists:sewa,id',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'metode_pembayaran' => 'required|string|max:40',
            'jumlah_pembayaran' => 'required|numeric',
            'detail_pembayaran' => ['required', 'string', Rule::in(TipePembayaranType::getAll())],
        ]);
        
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/payment-proof/'), $filename);
            $validated['bukti_pembayaran'] = $filename;
        }
        $validated['status_pembayaran'] = StatusPembayaranType::MENUNGGU->value;

        DB::beginTransaction();
        try {
            $pembayaran = Pembayaran::create($validated);
            DB::commit();
            return redirect()->route('user.order.index')->with('success', 'Pembayaran berhasil');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('errors', 'Pembayaran gagal');
        }
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Sewa $order)
    {
        $order->durasi_sewa = $this->cekDurasi($order->id);
        $pembayarans = Pembayaran::where('sewa_id', $order->id)->get();
        return view('GO.USER.Sewa.view', compact('order', 'pembayarans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bayar(string $id)
    {
        $sewa = Sewa::with('kendaraan')->findOrFail($id);
        $sewa->durasi_sewa = $this->cekDurasi($sewa->id);
        // dd($sewa);
        return view('GO.USER.Sewa.create', compact('sewa'));
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
