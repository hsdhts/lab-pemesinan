<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPreventive;
use App\Models\Maintenance;
use App\Models\Mesin;
use App\Models\Stasiun;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PreventiveMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalPreventive = JadwalPreventive::with(['mesin', 'stasiun'])
            ->orderBy('jadwal_berikutnya', 'asc')
            ->paginate(10);

        return view('pages.preventive.index', [
            'halaman' => 'Preventive Maintenance',
            'jadwalPreventive' => $jadwalPreventive
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mesins = Mesin::with('stasiun')->get();
        $stasiuns = Stasiun::all();
        
        return view('pages.preventive.create', [
            'halaman' => 'Tambah Preventive Maintenance',
            'mesins' => $mesins,
            'stasiuns' => $stasiuns
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mesin_id' => 'required|exists:mesins,id',
            'stasiun_id' => 'required|exists:stasiuns,id',
            'nama_preventive' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'periode' => 'required|integer|min:1',
            'satuan_periode' => 'required|in:hari,minggu,bulan,tahun',
            'tanggal_mulai' => 'required|date',
            'prioritas' => 'required|integer|in:1,2,3',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai);
            
            $jadwalPreventive = new JadwalPreventive();
            $jadwalPreventive->fill($request->all());
            $jadwalPreventive->tanggal_mulai = $tanggalMulai;
            $jadwalPreventive->jadwal_berikutnya = $jadwalPreventive->hitungJadwalBerikutnya($tanggalMulai);
            $jadwalPreventive->save();

            return redirect()->route('preventive.index')
                ->with('success', 'Jadwal preventive maintenance berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwalPreventive = JadwalPreventive::with(['mesin', 'stasiun'])->findOrFail($id);
        
        // Get riwayat jadwal yang dibuat dari preventive maintenance ini
        // Karena sekarang tidak ada relasi ke maintenance, kita cari berdasarkan keterangan
        $riwayatJadwal = Jadwal::where('keterangan', 'like', '%Generated from Preventive Maintenance: ' . $jadwalPreventive->nama_preventive . '%')
            ->orderBy('tanggal_rencana', 'desc')
            ->get();
        
        return view('pages.preventive.show', [
            'halaman' => 'Detail Preventive Maintenance',
            'jadwalPreventive' => $jadwalPreventive,
            'riwayatJadwal' => $riwayatJadwal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwalPreventive = JadwalPreventive::findOrFail($id);
        $mesins = Mesin::with('stasiun')->get();
        $stasiuns = Stasiun::all();
        
        return view('pages.preventive.edit', [
            'halaman' => 'Edit Preventive Maintenance',
            'jadwalPreventive' => $jadwalPreventive,
            'mesins' => $mesins,
            'stasiuns' => $stasiuns
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'mesin_id' => 'required|exists:mesins,id',
            'stasiun_id' => 'required|exists:stasiuns,id',
            'nama_preventive' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'periode' => 'required|integer|min:1',
            'satuan_periode' => 'required|in:hari,minggu,bulan,tahun',
            'tanggal_mulai' => 'required|date',
            'prioritas' => 'required|integer|in:1,2,3',
            'is_active' => 'boolean',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $jadwalPreventive = JadwalPreventive::findOrFail($id);
            $tanggalMulai = Carbon::parse($request->tanggal_mulai);
            
            $jadwalPreventive->fill($request->all());
            $jadwalPreventive->tanggal_mulai = $tanggalMulai;
            
            // Recalculate next schedule if periode or satuan_periode changed
            if ($jadwalPreventive->isDirty(['periode', 'satuan_periode'])) {
                $jadwalPreventive->jadwal_berikutnya = $jadwalPreventive->hitungJadwalBerikutnya(
                    $jadwalPreventive->jadwal_terakhir_dilakukan ?? $tanggalMulai
                );
            }
            
            $jadwalPreventive->save();

            return redirect()->route('preventive.index')
                ->with('success', 'Jadwal preventive maintenance berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $jadwalPreventive = JadwalPreventive::findOrFail($id);
            $jadwalPreventive->delete();

            return redirect()->route('preventive.index')
                ->with('success', 'Jadwal preventive maintenance berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Generate jadwal maintenance dari preventive maintenance yang jatuh tempo
     */
    public function generateJadwal()
    {
        try {
            $jadwalJatuhTempo = JadwalPreventive::jatuhTempo()->get();
            $generated = 0;

            foreach ($jadwalJatuhTempo as $preventive) {
                // Cari maintenance yang sesuai dengan mesin_id dari preventive
                $maintenance = Maintenance::where('mesin_id', $preventive->mesin_id)->first();
                
                if ($maintenance) {
                    // Cek apakah sudah ada jadwal untuk maintenance ini hari ini
                    $existingJadwal = Jadwal::where('maintenance_id', $maintenance->id)
                        ->whereDate('tanggal_rencana', Carbon::today())
                        ->first();

                    if (!$existingJadwal) {
                        // Buat jadwal baru
                        Jadwal::create([
                            'maintenance_id' => $maintenance->id,
                            'tanggal_rencana' => Carbon::now(),
                            'keterangan' => 'Generated from Preventive Maintenance: ' . $preventive->nama_preventive
                        ]);

                        // Update jadwal preventive berikutnya
                        $preventive->selesaiMaintenance();
                        $generated++;
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Berhasil generate {$generated} jadwal maintenance dari preventive maintenance",
                'generated' => $generated
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get jadwal preventive yang jatuh tempo
     */
    public function getJatuhTempo()
    {
        $jadwalJatuhTempo = JadwalPreventive::jatuhTempo()
            ->with(['mesin', 'stasiun'])
            ->orderBy('jadwal_berikutnya', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $jadwalJatuhTempo
        ]);
    }
}
