<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Jadwal;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalGuru = Guru::count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalKelas = Kelas::count();
        $totalMapel = MataPelajaran::count();
        $totalJadwal = Jadwal::count();
        
        return view('admin.dashboard', compact(
            'totalGuru', 'totalSiswa', 'totalKelas', 'totalMapel', 'totalJadwal'
        ));
    }
}