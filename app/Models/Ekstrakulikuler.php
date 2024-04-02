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
        return $this->hasOne(Siswa::class);
    }
}
