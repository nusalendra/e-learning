<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadTugas extends Model
{
    use HasFactory;
    protected $table = 'upload_tugas';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'mata_pelajaran_id', 'nama_tugas', 'upload_tugas'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function nilaiMataPelajaran() {
        return $this->hasOne(NilaiMataPelajaran::class);
    }
}
