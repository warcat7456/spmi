<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $fillable = ['name', 'name_long'];
    public $timestamps = true;
    public $table = 'lembaga';
}
