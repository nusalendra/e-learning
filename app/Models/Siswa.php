<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primarykey = 'id';
    protected $fillable = ['kelas_semester_id','ekstrakulikuler_id', 'nama', 'status_raport', 'nilai_akhir'];

    public function kelasSemester() {
        return $this->belongsTo(KelasSemester::class);
    }

    public function presensi() {
        return $this->hasMany(Presensi::class);
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class);
    }

    public function ekstrakulikuler() {
        return $this->belongsTo(Ekstrakulikuler::class);
    }
}
