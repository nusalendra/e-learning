<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;
    protected $table = 'data_siswa';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'NIS', 'NISN', 'jenis_kelamin', 'tempat_Lahir', 'tanggal_lahir', 'agama', 'pendidikan_sebelumnya', 'alamat'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
}
