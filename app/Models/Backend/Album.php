<?php

namespace App\Models\Backend;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;

// Traits
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use Filterable, HasFactory;

    // public $timestamps = true;
    // protected $table = 'albums';
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(AlbumItem::class);
    }

    public function albumItems(): HasMany
    {
        return $this->hasMany(AlbumItem::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getImageAttribute(): ?string
    {
        return $this->albumItems()->first()?->image ?? 'upload/images/placeholder_salon.jpg';
    }

    // Filter Search
    public function filterName(Builder $query, string $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
    }
}
