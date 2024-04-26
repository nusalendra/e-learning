<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaMataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'siswa_mata_pelajaran';
    protected $primarykey = 'id';
    protected $fillable = ['siswa_id', 'mata_pelajaran_id'];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class);
    }
}
