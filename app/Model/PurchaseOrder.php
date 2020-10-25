<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function purchaseOrderDetail()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
