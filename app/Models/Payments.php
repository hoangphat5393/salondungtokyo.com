<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payments extends Model
{
    use HasFactory;

    public $timestamps = true;
    public $table = 'payments';
    protected $guarded = [];

    // public function payment_info($related, $foreignKey = null, $localKey = null)
    // {
    // }

    public function payment_info(): HasOne
    {
        return $this->hasOne(PaymentInfos::class);
    }

    public function payment_request(): HasOne
    {
        return $this->hasOne(PaymentRequest::class);
    }
}
