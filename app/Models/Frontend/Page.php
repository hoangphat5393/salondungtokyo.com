<?php

namespace App\Models\Frontend;

use App\Models\Backend\User;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // protected $table = 'page';
    protected $guarded = [];

    protected $attributes = [
        'type' => 'page',
    ];

    /**
     * Bảng post_categories đã xóa; trả về collection rỗng để tương thích ngược.
     */
    public function getCategoriesAttribute()
    {
        return collect([]);
    }

    public function scopePosts($query)
    {
        return $query->where('type', 'post');
    }

    public function scopeServices($query)
    {
        return $query->where('type', 'service');
    }

    public function scopePages($query)
    {
        return $query->where(function ($q) {
            $q->where('type', 'page')->orWhereNull('type');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function search(string $keyword)
    {
        $keyword = '%'.addslashes($keyword).'%';
        $result = self::select('id', 'title', 'slug', 'description')
            ->where('title', 'like', $keyword)
            ->orWhere('parent', 'like', $keyword)
            ->get();

        return $result;
    }

    public function getTitleAttribute($value)
    {
        $lc = app()->getLocale();
        if ($lc == 'vi') {
            return $value;
        } else {
            return $this->{'title_'.$lc};
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
