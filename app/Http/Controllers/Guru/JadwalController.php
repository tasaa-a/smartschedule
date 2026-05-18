<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;
        
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }
        
        // Ambil jadwal mengajar untuk guru ini
        $jadwal = Jadwal::with(['kelas', 'mataPelajaran', 'jamPelajaran'])
            ->where('guru_id', $guru->id)
            ->orderBy('jam_pelajaran_id')
            ->get();
        
        // Kelompokkan berdasarkan hari
        $jadwalGroup = $jadwal->groupBy(function($item) {
            return $item->jamPelajaran->hari;
        });
        
        return view('guru.jadwal', compact('jadwalGroup', 'guru'));
    }
}