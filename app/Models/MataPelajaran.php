<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $primarykey = 'id';
    protected $fillable = ['wali_kelas_id','nama'];

    public function waliKelas() {
        return $this->belongsTo(WaliKelas::class);
    }

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class);
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class);
    }
}
