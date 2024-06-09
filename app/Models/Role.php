<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Dapatkan pengguna untuk peran tersebut.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
