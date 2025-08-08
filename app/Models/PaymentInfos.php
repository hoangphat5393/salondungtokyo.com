<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfos extends Model
{
    use HasFactory;

    public $timestamps = true;
    public $table = 'payment_infos';
    protected $guarded = [];
}
