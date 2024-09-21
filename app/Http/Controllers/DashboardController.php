<?php

namespace App\Http\Controllers;

use App\Enums\StatusPembayaranType;
use App\Enums\StatusSewaType;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Auth;
use App\Models\Sewa;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function home()
    {
        $kendaraans = Kendaraan::all();

        return view('GO.index', compact('kendaraans'));
    }
    public function admin()
    {
        // $pembayarans = Pembayaran::where('status_pembayaran', '!=', StatusPembayaranType::DITERIMA)->orderBy('created_at', 'desc')->get();
        $sewas = Sewa::where('status_sewa', '=', StatusSewaType::MENUNGGU)->get();

        DB::statement('SET @totalRevenue = 0');
        DB::statement('CALL getTotalRevenue(@totalRevenue)');
        $result = DB::select('SELECT @totalRevenue AS totalRevenue');
        $totalRevenue = $result[0]->totalRevenue;

        // $pembayarans = DB::select('CALL getPembayaranCheck()');
        $pembayarans = collect(DB::select('CALL getPembayaranCheck()'));

        return view('GO.ADMIN.dashboard',compact('pembayarans', 'sewas', 'totalRevenue'));
    }
    public function owner()
    {
        $owner = Pemilik::where('users_id', Auth::id())->first();
        $kendaraans = Kendaraan::where('pemilik_id', $owner->id)->get();
        $sewas = collect();
        foreach ($kendaraans as $kendaraan) {
            $sewa = Sewa::where('kendaraan_id', $kendaraan->id)->get();
            $sewas = $sewas->merge($sewa); // Menggabungkan hasil sewa ke dalam koleksi $sewas
        }

        DB::statement('SET @totalRevenue = 0');
        DB::statement('CALL getTotalRevenueOwner(?,@totalRevenue)', [$owner->id]);
        $result = DB::select('SELECT @totalRevenue AS totalRevenue');
        $totalRevenue = $result[0]->totalRevenue;

        // dd($owner->id); // Debugging
        return view('GO.OWNER.dashboard', compact('sewas', 'totalRevenue'));
    }
    public function user()
    {
        $sewas = Sewa::where('pelanggan_id', auth()->user()->pelanggan->id)->get();
        $denda = DB::select('SELECT getDendaPelanggan(?) as value', [Auth::user()->pelanggan->id]);
        $denda = $denda[0]->value;
        return view('GO.USER.dashboard', compact('sewas', 'denda'));
    }
    public function detail(Kendaraan $kendaraan)
    {
        $pelanggan = Pelanggan::where('users_id', auth()->id())->first();
        return view('GO.detail', compact('kendaraan', 'pelanggan'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'NIK' => 'required|numeric',
            'nomor_telepon' => 'required|numeric',
            'alamat' => 'required|string',
            'total_harga' => 'required|numeric',
            'kendaraan_id' => 'required|exists:kendaraan,id',
        ]);

        DB::beginTransaction();
        try {
            if (!Pelanggan::where('users_id', auth()->id())->exists()) {
                $pelanggan = Pelanggan::create([
                    'NIK' => $validated['NIK'],
                    'nomor_telepon' => $validated['nomor_telepon'],
                    'alamat' => $validated['alamat'],
                    'users_id' => auth()->id(),
                ]);
            }
            $pelanggan = Pelanggan::where('users_id', auth()->id())->first();
            $sewa = Sewa::create([
                'tanggal_sewa' => $validated['tanggal_sewa'],
                'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
                'total_harga' => $validated['total_harga'],
                'status_sewa' => 'menunggu',
                'kendaraan_id' => $validated['kendaraan_id'],
                'pelanggan_id' => $pelanggan->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
        return redirect(route('user.order.index'))->with('success', 'Sewa created successfully');
    }
    
}
