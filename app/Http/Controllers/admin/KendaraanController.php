<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Pemilik;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraans = Kendaraan::all();
        $countKendaraan = $this->getTotalKendaraan();
        confirmDelete('Delete data vehicle ', 'Are you sure you want to delete this vehicle data?');

        return view('GO.ADMIN.Kendaraan.index', compact('kendaraans', 'countKendaraan'));
    }

    public function getTotalKendaraan()
    {
        $countKendaraan = DB::select('SELECT countKendaraan() AS total')[0]->total;
        return json_decode($countKendaraan, true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TipeKendaraan::all();
        $pemiliks = Pemilik::all();
        return view('GO.ADMIN.Kendaraan.create',compact('types', 'pemiliks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe_kendaraan_id' => 'required|exists:tipe_kendaraan,id',
            'pemilik_id' => 'required|exists:pemilik,id',
            'plat' => 'required|string|max:255',
            'merk' => 'required|string',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
            'kondisi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/vehicle-images/'), $filename);
            $validated['foto'] = $filename;
        }

        DB::beginTransaction();
        try {
            Kendaraan::create($validated);
            DB::commit();
            return redirect()->route('admin.kendaraans.index')->with('success', 'Vehicle data successfully added');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'Failed to add vehicle data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kendaraan $kendaraan)
    {
        return view('GO.ADMIN.Kendaraan.view', compact('kendaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan)
    {
        $types = TipeKendaraan::all();
        $pemiliks = Pemilik::all();
        return view('GO.ADMIN.Kendaraan.edit', compact('kendaraan', 'types', 'pemiliks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe_kendaraan_id' => 'required|exists:tipe_kendaraan,id',
            'pemilik_id' => 'required|exists:pemilik,id',
            'plat' => 'required|string|max:255',
            'merk' => 'required|string',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
            'kondisi' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/vehicle-images/'), $filename);
            $validated['foto'] = $filename;
        }

        DB::beginTransaction();
        try {
            $kendaraan->update($validated);
            DB::commit();
            return redirect()->route('admin.kendaraans.index')->with('success', 'Vehicle data successfully updated');
        } catch (\Exception $e) {
            dd($e->getMessage()); 
            DB::rollBack();
            return redirect()->back()->with('errors', 'Vehicle data update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Kendaraan $data)
    public function destroy(Kendaraan $kendaraan)
    {
        DB::beginTransaction();
        try {
            $kendaraan->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Vehicle successfully deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'Vehicle deletion failed');
        }
    }
}
