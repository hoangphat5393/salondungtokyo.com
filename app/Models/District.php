<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['name', 'type', 'lat', 'lng', 'slug', 'city_id'];

    protected $dates = [];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */
    public function getResourceUrlAttribute()
    {
        return url('/admin/districts/' . $this->getKey());
    }

    // public function salesNew()
    // {
    //     return $this->hasMany(SalesNews::class, 'district_id', 'id');
    // }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class, 'district_id', 'id');
    }

    /**
     * SCROPE
     */

    public function scopeHaNoi($builder)
    {
        return $builder->where('city_id', 1);
    }
}
