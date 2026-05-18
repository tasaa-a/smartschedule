<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function cetakJadwal()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa || !$siswa->kelas_id) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }

        $kelas = $siswa->kelas;
        
        // Ambil jadwal berdasarkan kelas siswa, urutkan berdasarkan jam_pelajaran_id
        $jadwal = Jadwal::with(['mataPelajaran', 'guru', 'jamPelajaran'])
            ->where('kelas_id', $siswa->kelas_id)
            ->orderBy('jam_pelajaran_id')
            ->get();

        // Kelompokkan berdasarkan hari
        $jadwalGroup = $jadwal->groupBy(fn($item) => $item->jamPelajaran->hari);

        // Urutkan hari (Senin s/d Sabtu)
        $hariOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $jadwalGroup = collect($hariOrder)
            ->mapWithKeys(fn($hari) => [$hari => $jadwalGroup->get($hari, collect())])
            ->filter();

        $data = [
            'kelas'         => $kelas,
            'siswa'         => $siswa,
            'jadwalGroup'   => $jadwalGroup,
            'tanggal_cetak' => now()->format('d F Y H:i'),
        ];

        $pdf = Pdf::loadView('siswa.cetak-jadwal', $data);
        $pdf->setPaper('A4', 'portrait'); // <-- UBAH KE PORTRAIT

        return $pdf->stream('jadwal_kelas_' . $kelas->nama_kelas . '.pdf');
    }
}