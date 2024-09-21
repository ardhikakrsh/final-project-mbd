<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Pelanggan;
use App\Models\Sewa;
use Illuminate\Support\Facades\DB;


class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalians = Pengembalian::all();
        $pelanggans = Pelanggan::all();
        $countPengembalian = $this->getTotalPengembalian();
        confirmDelete('Delete data pengembalian ', 'Are you sure you want to delete this pengembalian data?');
        return view('GO.ADMIN.Pengembalian.index', compact('pengembalians', 'pelanggans', 'countPengembalian'));
    }

    public function getTotalPengembalian()
    {
        $countPengembalian = DB::select('SELECT countPengembalian() AS total')[0]->total;
        return json_decode($countPengembalian, true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil sewa yang belum dikembalikan
        $sewas = Sewa::whereDoesntHave('pengembalian')->get();
        return view('GO.ADMIN.Pengembalian.create', compact('sewas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sewa_id' => 'required|exists:sewa,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi' => 'required|string',
            'masalah' => 'required|boolean',
            // 'denda' => 'required|numeric',
        ]);

        Pengembalian::create($request->all());
        return redirect()->route('admin.pengembalians.index')->with('success', 'Pengembalian created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        return view('GO.ADMIN.Pengembalian.view', compact('pengembalian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        $sewas = Sewa::whereDoesntHave('pengembalian')->orWhere('id', $pengembalian->sewa_id)->get();
        return view('GO.ADMIN.Pengembalian.edit', compact('pengembalian', 'sewas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi' => 'required|string',
            'masalah' => 'required|boolean',
            'denda' => 'required|numeric',
        ]);

        $pengembalian->update($request->all());

        return redirect()->route('admin.pengembalians.index')->with('success', 'Pengembalian updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('admin.pengembalians.index')->with('success', 'Pengembalian deleted successfully.');
    }
}
