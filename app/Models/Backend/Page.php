<?php

namespace App\Models\Backend;

use App\Traits\Filterable;
use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;

class Page extends Model
{
    use Filterable, HasFactory;

    public $timestamps = true;

    // protected $table = 'page';
    protected $guarded = [];

    protected $attributes = [
        'type' => 'page',
    ];

    public static function newFactory()
    {
        return PageFactory::new();
    }

    public function scopePosts(Builder $query)
    {
        return $query->where('type', 'post');
    }

    public function scopeServices(Builder $query)
    {
        return $query->where('type', 'service');
    }

    public function scopePages(Builder $query)
    {
        if (Schema::hasColumn($this->getTable(), 'type')) {
            return $query->where(function ($q) {
                $q->where('type', 'page')->orWhereNull('type');
            });
        }

        return $query;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Bảng post_categories đã xóa theo chuẩn vattunongnghiep58 / 3nong. Trả về collection rỗng.
     */
    public function getCategoriesAttribute()
    {
        return collect([]);
    }

    // Filter Search
    public function filterName(Builder $query, string $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
    }

    public function getTitleAttribute()
    {
        return $this->attributes['name'] ?? null;
    }

    public function getTitleEnAttribute()
    {
        return $this->attributes['name_en'] ?? null;
    }
}
