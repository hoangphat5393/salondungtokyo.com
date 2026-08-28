<?php

namespace App\Models\Frontend;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use Filterable, HasFactory;

    // public $table = 'email_template';
    // protected $table = 'email_template';
    protected $guarded = [];
}
