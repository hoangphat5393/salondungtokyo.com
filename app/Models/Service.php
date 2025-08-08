<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Traits
use App\Traits\Filterable;

class Service extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Filter Search
    // public function filterCategoryId($query, $value)
    // {
    //     if ($value)
    //         return $query->whereHas('categories', function ($query) use ($value) {
    //             $query->where('id', $value);
    //         });
    // }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function filterName($query, $value)
    {
        return $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
