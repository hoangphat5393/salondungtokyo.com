<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $table = 'category';
    protected $guarded = [];

    public function parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent', 'id')->orderBy('sort');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'post_categories', 'category_id', 'post_id');
    }

    public function works(): BelongsToMany
    {
        return $this->belongsToMany(Work::class, 'work_categories', 'category_id', 'work_id');
    }

    public function getNameAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'name_' . $lc};
        }
    }

    public function getDescriptionAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'description_' . $lc};
        }
    }
}
