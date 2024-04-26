<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $primarykey = 'id';
    protected $fillable = ['kelas_semester_id', 'user_id', 'kategori_id', 'nama'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kelasSemester() {
        return $this->belongsTo(KelasSemester::class);
    }

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class);
    }

    public function uploadTugas() {
        return $this->hasMany(UploadTugas::class);
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class);
    }
}
