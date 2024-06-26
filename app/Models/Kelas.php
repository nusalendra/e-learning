<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primarykey = 'id';
    protected $fillable = ['periode_id', 'nama'];

    public function waliKelas() {
        return $this->hasOne(WaliKelas::class);
    }

    public function periode(){
        return $this->belongsTo(Periode::class);
    }

    public function kelasSemester() {
        return $this->belongsToMany(KelasSemester::class, 'kelas_semester', 'kelas_id', 'semester_id');
    }

    public function semester() {
        return $this->belongsToMany(Semester::class);
    }
}
