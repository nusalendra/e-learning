<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $primarykey = 'id';
    protected $fillable = ['tahun_ajaran'];

    public function kelasSemester() {
        return $this->hasMany(KelasSemester::class);
    }
}
