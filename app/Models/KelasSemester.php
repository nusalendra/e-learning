<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSemester extends Model
{
    use HasFactory;
    protected $table = 'kelas_semester';
    protected $primarykey = 'id';
    protected $fillable = ['periode_id', 'kelas_id', 'semester_id'];

    public function periode() {
        return $this->belongsTo(Periode::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function semester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
