<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler';
    protected $primarykey = 'id';
    protected $fillable = ['nama'];

    public function siswa() {
        return $this->belongsToMany(Siswa::class, 'ekstrakulikuler_siswa', 'ekstrakulikuler_id', 'siswa_id');
    }
}
