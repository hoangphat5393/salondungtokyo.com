<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

// Traits
use App\Traits\Filterable;

class Payments extends Model
{
    use HasFactory, Filterable;

    public $timestamps = true;
    // public $table = 'payments';
    protected $guarded = [];


    public function info(): HasOne
    {
        return $this->hasOne(PaymentInfos::class);
    }

    public function payment_request(): HasOne
    {
        return $this->hasOne(PaymentRequest::class);
    }

    public function payment_onepay_request(): HasOne
    {
        return $this->hasOne(PaymentOnepayRequest::class);
    }

    public function filterID($query, $value)
    {
        return $query->where('id', $value);
    }
}
