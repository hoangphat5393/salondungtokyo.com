<?php

namespace App\Models\Backend;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use Filterable, HasFactory;

    public $timestamps = false;

    // public $table = 'email_template';
    protected $guarded = [];
}
