<?php

namespace App\Http\Controllers\owner;

use App\Enums\VehicleType;
use App\Models\Kendaraan;
use App\Models\Pemilik; // Add this line to import the 'Pemilik' class
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owner = Pemilik::where('users_id', Auth::id())->first();
        $kendaraans = Kendaraan::where('pemilik_id', $owner->id)->get();
        confirmDelete('Delete data vehicle', 'Are you sure you want to delete this vehicle data?');
        return view('GO.OWNER.Kendaraan.index', compact('kendaraans', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = VehicleType::getValues();
        return view('GO.OWNER.Kendaraan.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $owner = Pemilik::where('Users_id', $userId)->first();
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'plat' => 'required|string|max:11',
            'warna' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'tipe_kendaraan_id' => 'required|integer|exists:tipe_kendaraan,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:255',
        ]);
        $validatedData['harga'] = (int)$validatedData['harga'];
        $validatedData['tipe_kendaraan_id'] = (int)$validatedData['tipe_kendaraan_id'];
        $validatedData['pemilik_id'] = $owner->id;
        // dd($validatedData);

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->move(public_path('assets/img//vehicle-images'), $fotoName);
                // $fotoPath = $request->file('foto')->storeAs('public/assets/img/vehicle-images', $fotoName);
                $validatedData['foto'] = $fotoName;
            }
            // dd($validatedData);
            $kendaraan = Kendaraan::create([
                'nama' =>  $validatedData['nama'],
                'merk' => $validatedData['merk'],
                'plat' => $validatedData['plat'],
                'warna' => $validatedData['warna'],
                'kondisi' => $validatedData['kondisi'],
                'harga' => (int)$validatedData['harga'],
                'pemilik_id' => (int)$validatedData['pemilik_id'],
                'tipe_kendaraan_id' => (int)$validatedData['tipe_kendaraan_id'],
                'foto' => $validatedData['foto'],
            ]);
            // dd($kendaraan);
            DB::commit();
            return redirect()->route('owner.kendaraan.index')->with('success', 'Vehicle created successfully');
        } catch (\Exception $e) {
            // dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Vehicle creation failed: ' . $e->getMessage());
        }
        dd("end");
    }

    /**
     * Display the specified resource.
     */
    public function show(Kendaraan $kendaraan)
    {
        return view('GO.OWNER.Kendaraan.view', compact('kendaraan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $roles = VehicleType::getValues();
        return view('GO.OWNER.Kendaraan.edit', compact('kendaraan', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'plat' => 'required|string|max:11',
            'warna' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'tipe_kendaraan_id' => 'required|integer|exists:tipe_kendaraan,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->move(public_path('assets/img/vehicle-images'), $fotoName);
                $validatedData['foto'] = $fotoName;

                // Hapus foto lama jika ada
                if ($kendaraan->foto) {
                    $oldFotoPath = public_path('assets/img/vehicle-images/' . $kendaraan->foto);
                    if (file_exists($oldFotoPath)) {
                        unlink($oldFotoPath);
                    }
                }
            } else {
                // Tetap gunakan foto lama jika tidak ada foto baru yang diupload
                unset($validatedData['foto']);
            }

            $kendaraan->update($validatedData);

            DB::commit();
            return redirect()->route('owner.kendaraan.index')->with('success', 'Vehicle updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Vehicle update failed: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        db::beginTransaction();
        try {
            $kendaraan->delete();
            db::commit();
        } catch (\Exception $e) {
            db::rollback();
            return redirect()->back()->with('error', 'Vehicle deletion failed: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Vehicle deleted successfully');
    }
}
