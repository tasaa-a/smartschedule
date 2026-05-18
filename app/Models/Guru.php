<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id', 'nip', 'nama'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jadwal() {
        return $this->hasMany(Jadwal::class);
    }

    public function ketidakhadiran() {
        return $this->hasMany(KetidakhadiranGuru::class);
    }

    public function mapel() {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mapel', 'guru_id', 'mata_pelajaran_id');
    }
}