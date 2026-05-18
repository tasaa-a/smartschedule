<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamPelajaran;
use Illuminate\Http\Request;

class JamController extends Controller
{
    public function index()
    {
        $jam = JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
        return view('admin.jam.index', compact('jam'));
    }

    public function create()
    {
        $jam = \App\Models\JamPelajaran::orderBy('hari')->orderBy('jam_mulai')->get();
        return view('admin.jam.create', compact('jam'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        JamPelajaran::create($request->all());

        return redirect()->route('admin.jam.index')
            ->with('success', 'Jam pelajaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jam = JamPelajaran::findOrFail($id);
        return view('admin.jam.edit', compact('jam'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $jam = JamPelajaran::findOrFail($id);
        $jam->update($request->all());

        return redirect()->route('admin.jam.index')
            ->with('success', 'Jam pelajaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $jam = JamPelajaran::findOrFail($id);
        $jam->delete();

        return redirect()->route('admin.jam.index')
            ->with('success', 'Jam pelajaran berhasil dihapus!');
    }
}