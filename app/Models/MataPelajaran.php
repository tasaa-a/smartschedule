<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    protected $fillable = ['nama_mapel', 'durasi_jam'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function guru() {
        return $this->belongsToMany(Guru::class, 'guru_mapel', 'mata_pelajaran_id', 'guru_id');
    }
}