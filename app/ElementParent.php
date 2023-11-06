<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementParent extends Model
{

    protected $fillable = ['bobot', 'indikator_id', 'deskripsi'];
    public $timestamps = false;
    public $table = 'elements_parent';

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'id', 'indator');
    }

    // public function scopreGetWithElement(){
    //     ElementParent::
    // }
}
