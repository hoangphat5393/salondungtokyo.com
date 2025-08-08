<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'slug',
    ];


    protected $dates = [];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/cities/' . $this->getKey());
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    function getName()
    {
        $name = $this->name;
        $name = str_replace('Thành Phố', '', $name);
        $name = str_replace('Thành phố', '', $name);
        $name = str_replace('Tỉnh', '', $name);
        return trim($name);
    }
}
