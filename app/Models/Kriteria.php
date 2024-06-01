<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bobots()
    {
        return $this->hasMany(Bobot::class, 'kode_kriteria', 'kode_kriteria');
    }
}
