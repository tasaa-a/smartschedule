<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;  
use App\Models\Guru;
use App\Models\JamPelajaran;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
{
    $kelasList = Kelas::all();
    $selectedKelas = request()->get('kelas_id', $kelasList->first()->id ?? null);
    
    $jadwalGroup = [];
    if ($selectedKelas) {
        // Ambil jadwal untuk kelas ini
        $jadwal = Jadwal::with(['kelas', 'mataPelajaran', 'guru', 'jamPelajaran'])
            ->where('kelas_id', $selectedKelas)
            ->orderBy('jam_pelajaran_id')
            ->get();
        
        // Kelompokkan berdasarkan mapel
        $jadwalGroup = [];
        foreach ($jadwal as $j) {
            $key = $j->mata_pelajaran_id;
            if (!isset($jadwalGroup[$key])) {
                $jadwalGroup[$key] = [
                    'mata_pelajaran' => $j->mataPelajaran,
                    'guru' => $j->guru,
                    'jam' => [],
                    'jam_ids' => [],
                ];
            }
            $jadwalGroup[$key]['jam'][] = $j->jamPelajaran;
            $jadwalGroup[$key]['jam_ids'][] = $j->id;
        }
    }
    
    return view('admin.jadwal.index', compact('kelasList', 'selectedKelas', 'jadwalGroup'));
}

    public function create()
{
    $kelas = \App\Models\Kelas::all();
    $mapel = \App\Models\MataPelajaran::all();
    $guru = \App\Models\Guru::all();
    $jam = \App\Models\JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
    
    return view('admin.jadwal.create', compact('kelas', 'mapel', 'guru', 'jam'));
}

public function store(Request $request)
{
    $request->validate([
        'kelas_id' => 'required',
        'mata_pelajaran_id' => 'required',
        'guru_id' => 'required',
        'jam_mulai_id' => 'required|exists:jam_pelajaran,id',
    ]);

    $mapel = \App\Models\MataPelajaran::find($request->mata_pelajaran_id);
    $durasi = $mapel->durasi_jam;

    $semuaJam = \App\Models\JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
    $jamMulai = \App\Models\JamPelajaran::find($request->jam_mulai_id);

    $indexMulai = $semuaJam->search(function($item) use ($jamMulai) {
        return $item->id == $jamMulai->id;
    });

    if ($indexMulai === false) {
        return back()->with('error', 'Jam mulai tidak valid.');
    }

    $slotDiperlukan = $semuaJam->slice($indexMulai, $durasi);

    if ($slotDiperlukan->count() < $durasi) {
        return back()->with('error', 'Tidak cukup slot jam tersisa untuk mapel ini.');
    }

    foreach ($slotDiperlukan as $slot) {
        $kelasBentrok = \App\Models\Jadwal::where('kelas_id', $request->kelas_id)
            ->where('jam_pelajaran_id', $slot->id)
            ->exists();
        $guruBentrok = \App\Models\Jadwal::where('guru_id', $request->guru_id)
            ->where('jam_pelajaran_id', $slot->id)
            ->exists();
        if ($kelasBentrok || $guruBentrok) {
            return back()->with('error', 'Salah satu slot waktu untuk mapel ini bentrok dengan jadwal lain.');
        }
    }

    foreach ($slotDiperlukan as $slot) {
        \App\Models\Jadwal::create([
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            'jam_pelajaran_id' => $slot->id,
        ]);
    }

    return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan ('.$durasi.' slot jam).');
}

public function edit($id)
{
    $jadwal = Jadwal::findOrFail($id);
    $kelas = Kelas::all();
    $mapel = MataPelajaran::all();
    $guru = Guru::all();
    $jam = JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
    
    return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'mapel', 'guru', 'jam'));
}

public function update(Request $request, $id)
{
    $jadwal = Jadwal::findOrFail($id);
    
    $request->validate([
        'kelas_id' => 'required',
        'mata_pelajaran_id' => 'required',
        'guru_id' => 'required',
        'jam_pelajaran_id' => 'required|exists:jam_pelajaran,id',
    ]);

    // Cek bentrok kelas (abaikan jadwal yang sedang diedit)
    $kelasBentrok = Jadwal::where('kelas_id', $request->kelas_id)
        ->where('jam_pelajaran_id', $request->jam_pelajaran_id)
        ->where('id', '!=', $id)
        ->exists();

    if ($kelasBentrok) {
        return back()->with('error', 'Kelas sudah memiliki jadwal di jam ini!');
    }

    // Cek bentrok guru (abaikan jadwal yang sedang diedit)
    $guruBentrok = Jadwal::where('guru_id', $request->guru_id)
        ->where('jam_pelajaran_id', $request->jam_pelajaran_id)
        ->where('id', '!=', $id)
        ->exists();

    if ($guruBentrok) {
        return back()->with('error', 'Guru sudah mengajar di jam ini!');
    }

    $jadwal->update([
        'kelas_id' => $request->kelas_id,
        'mata_pelajaran_id' => $request->mata_pelajaran_id,
        'guru_id' => $request->guru_id,
        'jam_pelajaran_id' => $request->jam_pelajaran_id,
    ]);

    return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate!');
}

public function destroyGroup($kelas_id, $mapel_id)
{
    // Hapus semua jadwal untuk kelas dan mapel ini
    $deleted = Jadwal::where('kelas_id', $kelas_id)
        ->where('mata_pelajaran_id', $mapel_id)
        ->delete();
    
    return redirect()->route('admin.jadwal.index', ['kelas_id' => $kelas_id])
        ->with('success', "$deleted jadwal berhasil dihapus.");
}

public function editGroup($kelas_id, $mapel_id)
{
    // Ambil semua jadwal untuk kelas dan mapel ini
    $jadwalList = Jadwal::where('kelas_id', $kelas_id)
        ->where('mata_pelajaran_id', $mapel_id)
        ->orderBy('jam_pelajaran_id')
        ->get();
    
    if ($jadwalList->isEmpty()) {
        return redirect()->route('admin.jadwal.index')->with('error', 'Jadwal tidak ditemukan.');
    }
    
    $kelas = Kelas::find($kelas_id);
    $mapel = MataPelajaran::find($mapel_id);
    $guru = Guru::find($jadwalList->first()->guru_id);
    $jamList = JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
    
    // Ambil jam pertama (jam mulai)
    $jamMulaiId = $jadwalList->first()->jam_pelajaran_id;
    
    return view('admin.jadwal.edit-group', compact('kelas', 'mapel', 'guru', 'jamList', 'jamMulaiId', 'kelas_id', 'mapel_id'));
}

public function updateGroup(Request $request, $kelas_id, $mapel_id)
{
    $request->validate([
        'guru_id' => 'required',
        'jam_mulai_id' => 'required|exists:jam_pelajaran,id',
    ]);
    
    $mapel = MataPelajaran::find($mapel_id);
    $durasi = $mapel->durasi_jam;
    
    // Hapus jadwal lama
    Jadwal::where('kelas_id', $kelas_id)
        ->where('mata_pelajaran_id', $mapel_id)
        ->delete();
    
    // Ambil semua jam
    $semuaJam = JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
    $jamMulai = JamPelajaran::find($request->jam_mulai_id);
    
    $indexMulai = $semuaJam->search(function($item) use ($jamMulai) {
        return $item->id == $jamMulai->id;
    });
    
    if ($indexMulai === false) {
        return back()->with('error', 'Jam mulai tidak valid.');
    }
    
    $slotDiperlukan = $semuaJam->slice($indexMulai, $durasi);
    
    if ($slotDiperlukan->count() < $durasi) {
        return back()->with('error', 'Tidak cukup slot jam tersisa untuk mapel ini.');
    }
    
    // Cek bentrok
    foreach ($slotDiperlukan as $slot) {
        $kelasBentrok = Jadwal::where('kelas_id', $kelas_id)
            ->where('jam_pelajaran_id', $slot->id)
            ->exists();
        $guruBentrok = Jadwal::where('guru_id', $request->guru_id)
            ->where('jam_pelajaran_id', $slot->id)
            ->exists();
        if ($kelasBentrok || $guruBentrok) {
            return back()->with('error', 'Salah satu slot waktu bentrok dengan jadwal lain.');
        }
    }
    
    // Simpan jadwal baru
    foreach ($slotDiperlukan as $slot) {
        Jadwal::create([
            'kelas_id' => $kelas_id,
            'mata_pelajaran_id' => $mapel_id,
            'guru_id' => $request->guru_id,
            'jam_pelajaran_id' => $slot->id,
        ]);
    }
    
    return redirect()->route('admin.jadwal.index', ['kelas_id' => $kelas_id])
        ->with('success', 'Jadwal berhasil diupdate ('.$durasi.' slot).');
}
}