<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Kriteria
 *
 * @property int $id
 * @property string $name
 * @property string $kode
 * @property int $level
 * @property int $parent_id
 * @property int $lembaga_id
 * @property int $jenjang_id
 *
 * @property Kriteria|null $parent
 * @property Collection|Kriteria[] $children
 */
class Kriteria extends Model
{
    protected $fillable = ['name', 'kode', 'level', 'parent_id', 'lembaga_id', 'jenjang_id'];

    protected $parentColumn = 'parent_id';

    public $table = 'kriteria';

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, $this->parentColumn);
    }

    /**
     * @return HasMany
     */
    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }

    /**
     * @return Kriteria
     */
    public function root(): Kriteria
    {
        return $this->parent
            ? $this->parent->root()
            : $this;
    }

    /**
     * @return BelongsTo
     */
    public function lembaga(): BelongsTo
    {
        return $this->belongsTo(Lembaga::class);
    }

    /**
     * @return BelongsTo
     */
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeFilterJenjang(Builder $query, int $id): Builder
    {
        return $query->where('jenjang_id', $id);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeFilterLembaga(Builder $query, int $id): Builder
    {
        return $query->where('lembaga_id', $id);
    }

    /**
     * @param Builder $query
     * @param int $level
     * @return Builder
     */
    public function scopeFilterLevel(Builder $query, int $level): Builder
    {
        return $query->where('level', $level);
    }
}
