<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'category';

    public function parent()
    {
        return $this->hasOne(NewsCategory::class, 'id', 'parent');
    }

    public function children()
    {
        return $this->hasMany(NewsCategory::class, 'parent', 'id')->orderBy('sort');
    }

    public function posts()
    {
        return $this->belongsToMany(News::class, 'post_categories', 'category_id', 'post_id');
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
