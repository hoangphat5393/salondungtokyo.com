<?php

namespace App\Models\Backend;

// use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Filterable;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Traits
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use Filterable, HasFactory;

    public $timestamps = true;

    // protected $table = 'post';
    protected $guarded = [];

    public static function newFactory()
    {
        return PostFactory::new();
    }

    public function categories(): BelongsToMany
    {
        // return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function filterName($query, $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
    }
}
