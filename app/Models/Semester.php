<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';
    protected $primarykey = 'id';
    protected $fillable = ['nama'];

    public function kelas() {
        return $this->belongsToMany(Kelas::class);
    }

    public function kelasSemester() {
        return $this->belongsToMany(KelasSemester::class, 'kelas_semester', 'semester_id', 'kelas_id');
    }
}
