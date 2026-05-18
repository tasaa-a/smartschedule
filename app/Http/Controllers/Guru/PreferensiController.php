<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JamPelajaran;
use App\Models\KetidakhadiranGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferensiController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;
        $semuaJam = JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
        
        // Ambil jam yang sudah dipilih (tidak tersedia)
        $jamTerpilih = KetidakhadiranGuru::where('guru_id', $guru->id)
            ->pluck('jam_pelajaran_id')
            ->toArray();
        
        return view('guru.preferensi', compact('semuaJam', 'jamTerpilih', 'guru'));
    }
    
    public function update(Request $request)
    {
        $guru = Auth::user()->guru;
        
        // Hapus semua preferensi lama
        KetidakhadiranGuru::where('guru_id', $guru->id)->delete();
        
        // Simpan preferensi baru
        if ($request->has('jam_tidak_tersedia')) {
            foreach ($request->jam_tidak_tersedia as $jamId) {
                KetidakhadiranGuru::create([
                    'guru_id' => $guru->id,
                    'jam_pelajaran_id' => $jamId,
                ]);
            }
        }
        
        return redirect()->route('guru.preferensi')->with('success', 'Preferensi waktu berhasil disimpan.');
    }
}