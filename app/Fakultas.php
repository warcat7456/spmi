<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    //
    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }
}
