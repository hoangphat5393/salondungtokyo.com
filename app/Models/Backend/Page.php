<?php

namespace App\Models\Backend;

use App\Traits\Filterable;
use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    use Filterable, HasFactory;

    public $timestamps = true;

    // protected $table = 'page';
    protected $guarded = [];

    public static function newFactory()
    {
        return PageFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

    // Filter Search
    public function filterName(Builder $query, string $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
    }
}
