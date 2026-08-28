<?php

namespace App\Models\Backend;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Trails
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use Filterable, HasFactory;

    public $timestamps = true;

    protected $guarded = [];

    public function filterName(Builder $query, string $value)
    {
        return $query->where('name', 'LIKE', '%'.$value.'%');
    }

    public function filterEmail(Builder $query, string $value)
    {
        return $query->where('email', 'LIKE', '%'.$value.'%');
    }
}
