<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetidakhadiranGuru extends Model
{
    protected $table = 'ketidakhadiran_guru';
    protected $fillable = ['guru_id', 'jam_pelajaran_id'];

    public function guru() {
        return $this->belongsTo(Guru::class);
    }

    public function jamPelajaran() {
        return $this->belongsTo(JamPelajaran::class);
    }
}