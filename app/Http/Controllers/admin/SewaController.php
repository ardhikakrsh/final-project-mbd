<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use App\Models\Kendaraan;
use App\Models\User;
use App\Enums\RolesType;
use App\Enums\StatusSewaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sewas = Sewa::all();
        $countOrder = $this->getTotalSewa();
        foreach ($sewas as $sewa) {
            $sewa->durasi_sewa = $this->cekDurasi($sewa->id);
        }
        confirmDelete('Delete data order ', 'Are you sure you want to delete this order data?');

        return view('GO.ADMIN.Sewa.index', compact('sewas', 'countOrder'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraans = Kendaraan::with('pemilik')->get();
        $users = User::where('role', RolesType::USER)->get();
        return view('GO.ADMIN.Sewa.create', compact('kendaraans', 'users'));

    }

    public function getTotalSewa()
    {
        $countOrder = DB::select('SELECT countOrder() AS total')[0]->total;
        return json_decode($countOrder, true);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     'tanggal_sewa' => 'required|date',
    //         'tanggal_perkiraan_kembali' => 'required|date',
    //         'kendaraan_id' => 'required|exists:kendaraans,id',
    //         'users_id' => 'required|exists:users,id',
    // }
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
        // dd($pelanggan_id);

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
            return redirect(route('admin.orders.index'))->with('success', 'Sewa successfully created');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('admin.orders.create'))->withErrors(['errors' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Sewa $order)
    {
        $order->durasi_sewa = $this->cekDurasi($order->id);
        return view('GO.ADMIN.Sewa.view', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sewa $order)
    {
        $status = StatusSewaType::getStatuses();
        $order->durasi_sewa = $this->cekDurasi($order->id);
        return view('GO.ADMIN.Sewa.edit', compact('order', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sewa $order)
    {
        $data = $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'total_harga' => 'required|numeric',
            'status_sewa' => 'required|in:' . implode(',', StatusSewaType::getStatuses()),
        ]);

       
        db::beginTransaction();
        try {
            $order->update($data);
            DB::commit();
            return redirect(route('admin.orders.index'))->with('success', 'Sewa successfully updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('admin.orders.edit', $order))->withErrors(['errors' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sewa $order)
    {
        DB::beginTransaction();
        try {
            $order->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Vehicle successfully deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'Vehicle deletion failed');
        }
    }

    public function cekDurasi($id)
    {
        $result = DB::select('SELECT cekDurasi(?) as durasi_sewa', [$id]);
        return $result[0]->durasi_sewa;
    }

    public function verify(Sewa $order)
    {
        try{
            DB::statement('CALL check_and_update_sewa_status(?)', [$order->id]);
            return redirect()->route('admin.orders.index')->with('success', 'Status sewa successfully updated');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Failed to update status sewa');

        }
    }
}
