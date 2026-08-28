<?php

namespace App\Models\Frontend;

// use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Traits
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use Filterable, HasFactory;

    public $timestamps = true;

    // protected $table = 'post';
    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        // return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // Filter Search
    public function filterCategoryId($query, $value)
    {
        if ($value) {
            return $query->whereHas('categories', function ($query) use ($value) {
                $query->where('id', $value);
            });
        }
        // return $query->join('post_category', 'post_id', 'post.id')->where('category_id', $value);
    }

    // Get Attribute
    public function filterName($query, $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
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

    public function getContentAttribute($value)
    {
        $lc = app()->getLocale();
        if ($lc == 'vi') {
            return $value;
        } else {
            return $this->{'content_'.$lc};
        }
    }
}
