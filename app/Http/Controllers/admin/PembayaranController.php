<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pengembalian; 
use App\Models\Sewa;
use App\Enums\TipePembayaranType;
use App\Enums\StatusPembayaranType;
use App\Enums\StatusSewaType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::all();
        $pengembalians = Pengembalian::all();
        $countPembayaran = $this->getTotalPembayaran();
        confirmDelete('Delete data pembayaran ', 'Are you sure you want to delete this data pembayaran?');
        return view('GO.ADMIN.Pembayaran.index', compact('pembayarans', 'pengembalians', 'countPembayaran'));
    }

    public function getTotalPembayaran()
    {
        $countPembayaran = DB::select('SELECT countPembayaran() AS total')[0]->total;
        return json_decode($countPembayaran, true);
    }


    public function verify(Pembayaran $pembayaran)
    {
        try {
            // Panggil prosedur yang mengubah status pembayaran
            DB::statement('CALL update_status_pembayaran(?)', [$pembayaran->id]);
            return redirect()->route('admin.pembayarans.index')->with('success', 'Pembayaran verified successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.pembayarans.index')->with('error', 'Failed to verify payment.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TipePembayaranType::getAll();
        $status = StatusSewaType::getStatuses();
        $sewas = Sewa::where('status_sewa', '!=', StatusSewaType::SELESAI)->get();
        return view('GO.ADMIN.Pembayaran.create',compact('types','status', 'sewas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
                'sewa_id' => 'required|exists:sewa,id',
                'metode_pembayaran' => 'required|string|max:40',
                'jumlah_pembayaran' => 'required|numeric',
                'detail_pembayaran' => ['required', 'string', Rule::in(TipePembayaranType::getAll())],
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status_pembayaran' => ['required', 'string', Rule::in(StatusSewaType::getStatuses())],
            ]);
            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/payment-proof/'), $filename);
                $validated['bukti_pembayaran'] = $filename;
            }
        DB::beginTransaction();
        try {
            Pembayaran::create($validated);
            DB::commit();
            return redirect()->route('admin.pembayarans.index')->with('success', 'Pembayaran successfully created');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('errors', 'Pembayaran failed to create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('GO.ADMIN.Pembayaran.view', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $types = TipePembayaranType::getAll();
        $status = StatusPembayaranType::getAll();
        return view('GO.ADMIN.Pembayaran.edit', compact('pembayaran', 'types', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'sewa_id' => 'required|exists:sewa,id',
            'metode_pembayaran' => 'required|string|max:40',
            'jumlah_pembayaran' => 'required|numeric',
            'detail_pembayaran' => ['required', 'string', Rule::in(TipePembayaranType::getAll())],
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_pembayaran' => ['required', 'string', Rule::in(StatusSewaType::getStatuses())],
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/payment-proof/'), $filename);
            $validated['bukti_pembayaran'] = $filename;
        }
        DB::beginTransaction();
        try {
            $pembayaran->update($validated);
            DB::commit();
            return redirect()->route('admin.pembayarans.index')->with('success', 'Pembayaran successfully updated');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('errors', 'Pembayaran failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        DB::beginTransaction();
        try {
            $pembayaran->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran successfully deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'Pembayaran deletion failed');
        }
    }
}
