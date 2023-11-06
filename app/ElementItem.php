<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementItem extends Model
{
    protected $fillable = ['prodi_id', 'elements_parent_id', 'score_berkas', 'score_hitung', 'count_berkas', 'min_akreditasi', 'status_akreditasi', 'min_unggul', 'status_unggul', 'min_baik', 'status_baik', 'ket_auditor'];
    public $timestamps = false;
    public $table = 'elements_item';

    public function elements_parent()
    {
        return $this->hasOne(ElementParent::class);
    }

    public function scopeGetElement($query)
    {
        $query->selectRaw('ep.id as id_parent, elements_item.*, ep.deskripsi, ep.bobot')
            ->selectRaw('i.dec as ind_name , lv1.name as l1_name, lv2.name as l2_name, lv3.name as l3_name, lv4.name as l4_name')
            ->rightJoin('elements_parent as ep', 'ep.id', '=', 'elements_item.elements_parent_id')
            ->leftJoin('indikators as i', 'i.id', '=', 'ep.indikator_id')
            ->leftJoin('l1_s as lv1', 'i.l1_id', '=', 'lv1.id')
            ->leftJoin('l2_s as lv2', 'i.l2_id', '=', 'lv2.id')
            ->leftJoin('l3_s as lv3', 'i.l3_id', '=', 'lv3.id')
            ->leftJoin('l4_s as lv4', 'i.l4_id', '=', 'lv4.id');


        return  $res = $query->get();
    }
}
