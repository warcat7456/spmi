<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    //
    protected $fillable = ['name', 'kode', 'level', 'parent_id', 'lembaga_id', 'jenjang_id'];
    public $timestamps = false;
    public $table = 'kriteria';

    public function children()
    {
        return $this->hasMany(Kriteria::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Kriteria::class, 'parent_id');
    }

    public function getNestedStructure()
    {
        $nestedStructure = $this->attributes;
        $nestedStructure['children'] =  $this->getChildrenStructure($this->kode);
        // dd($this->attributes);

        return $nestedStructure;
    }

    protected function getChildrenStructure($kode)
    {
        $childrenStructure = [];

        foreach ($this->children as $child) {
            $childrenStructure[] = [
                'id' => $child->id,
                'full_kode' => $kode . '.' . $child->kode,
                'name' => $child->name,
                'kode' => $child->kode,
                'level' => $child->level,
                'children' => $child->getChildrenStructure($kode . '.' . $child->kode),
            ];
        }

        return $childrenStructure;
    }

    public function scopeGetChild($query, $filter = [])
    {
        $data = [];
        $query->selectRaw('kriteria.*, lembaga.name as nama_lembaga')
            ->join('lembaga', 'lembaga.id', '=', 'kriteria.lembaga_id')
            ->where('level', 1);

        if (!empty($filter['lembaga_id']))
            $query->where('lembaga_id', $filter['lembaga_id']);
        if (!empty($filter['jenjang_id']))
            $query->where('jenjang_id', $filter['jenjang_id']);

        $lv1 = $query->whereNotNull('lembaga_id')
            ->get();
        foreach ($lv1 as $d) {
            $data[] = $d->getNestedStructure();
        }
        return $data;
    }
}
