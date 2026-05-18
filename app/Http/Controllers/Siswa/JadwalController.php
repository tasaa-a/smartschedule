<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil data siswa dari user yang login
        $siswa = Auth::user()->siswa;
        
        // Cek apakah siswa ditemukan dan punya kelas
        if (!$siswa || !$siswa->kelas_id) {
            return view('siswa.jadwal', [
                'jadwalGroup' => collect(),
                'error' => 'Anda belum memiliki kelas. Hubungi admin.',
                'siswa' => $siswa
            ]);
        }

        // Ambil jadwal berdasarkan kelas siswa
        $jadwal = Jadwal::with(['kelas', 'mataPelajaran', 'guru', 'jamPelajaran'])
            ->where('kelas_id', $siswa->kelas_id)
            ->orderBy('jam_pelajaran_id')
            ->get();

        $jadwalGroup = $jadwal->groupBy(fn($item) => $item->jamPelajaran->hari);

        return view('siswa.jadwal', compact('jadwalGroup', 'siswa'));
    }
}