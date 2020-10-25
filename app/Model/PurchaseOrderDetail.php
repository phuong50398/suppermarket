<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
