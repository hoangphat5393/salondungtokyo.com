<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = [];

    public function parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent', 'id')->orderBy('sort');
    }

    /**
     * Bảng post_categories đã xóa; tin tức lưu trong bảng pages (type=post). Trả về collection rỗng.
     */
    public function getPostsAttribute()
    {
        return collect([]);
    }

    public function getNameAttribute($value)
    {
        $lc = app()->getLocale();
        if ($lc == 'vi') {
            return $value;
        } else {
            return $this->{'name_'.$lc};
        }
    }

    public function getDescriptionAttribute($value)
    {
        $lc = app()->getLocale();
        if ($lc == 'vi') {
            return $value;
        } else {
            return $this->{'description_'.$lc};
        }
    }
}
