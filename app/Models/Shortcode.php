<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use App\Traits\Filterable;

class Shortcode extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Filter Search
    public function filterName($query, $value)
    {
        return $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
