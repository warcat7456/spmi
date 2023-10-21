<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    //{
    protected $fillable = ['nama', 'singkatan', 'urutan', 'deskripsi', 'visi', 'misi', 'foto'];
    public $timestamps = false;

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }

    public function scopeNotIn($query)
    {
        return $query->whereNotIn('id', [0])->orderBy('nama', 'ASC')->get();
    }
}
