<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';
    protected $primarykey = 'id';
    protected $fillable = ['kelas_id', 'nama'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}
