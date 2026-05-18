<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamPelajaran extends Model
{
    protected $table = 'jam_pelajaran';
    protected $fillable = ['hari', 'jam_mulai', 'jam_selesai'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function ketidakhadiranGuru()
    {
        return $this->hasMany(KetidakhadiranGuru::class);
    }
}