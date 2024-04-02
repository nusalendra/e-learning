<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangPresensi extends Model
{
    use HasFactory;
    protected $table = 'ruang_presensi';
    protected $primarykey = 'id';
    protected $fillable = ['tanggal_presenesi'];

    public function presensi() {
        return $this->hasMany(Presensi::class);
    }
}
