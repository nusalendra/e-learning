<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primarykey = 'id';
    protected $fillable = ['nama'];

    public function mataPelajaran() {
        return $this->hasMany(MataPelajaran::class);
    }
}
