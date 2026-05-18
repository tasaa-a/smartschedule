<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
public function exportJadwal()
{
    $guru = Auth::user()->guru;
    
    if (!$guru) {
        return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
    }
    
    $jadwal = Jadwal::with(['kelas', 'mataPelajaran', 'jamPelajaran'])
        ->where('guru_id', $guru->id)
        ->orderBy('jam_pelajaran_id')
        ->get();
    
    // Kelompokkan berdasarkan hari dan urutkan
    $jadwalGroup = $jadwal->groupBy(fn($item) => $item->jamPelajaran->hari);
    $hariOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $jadwalGroup = collect($hariOrder)
        ->mapWithKeys(fn($hari) => [$hari => $jadwalGroup->get($hari, collect())])
        ->filter();
    
    $data = [
        'guru'          => $guru,
        'jadwalGroup'   => $jadwalGroup,
        'tanggal_cetak' => now()->format('d F Y H:i'),
    ];
    
    $pdf = Pdf::loadView('guru.export-pdf', $data);
    $pdf->setPaper('A4', 'portrait'); // ← portrait seperti siswa
    
    return $pdf->stream('jadwal_mengajar_' . $guru->nama . '.pdf');
}
}