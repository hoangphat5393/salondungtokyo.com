<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

// Trails
use App\Traits\Filterable;

class Subscription extends Model
{
    use HasFactory, Filterable;

    protected $table = 'subscription';
    // protected $fillable = [
    //     'id', 'email', 'created_at', 'updated_at',
    // ];
    protected $guarded = [];

    public function filterEmail(Builder $query, string $value)
    {
        return $query->where('email', 'LIKE', '%' . $value . '%');
    }
}
