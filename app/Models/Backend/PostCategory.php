<?php

namespace App\Models\Backend;

use App\Traits\Filterable;
use App\Traits\LocalizeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Traits
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PostCategory extends Model
{
    use Filterable, HasFactory, LocalizeController;

    // public $timestamps = true;
    // protected $table = 'post_category';
    protected $guarded = [];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Filter Search
    public function filterName($query, $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
    }
}
