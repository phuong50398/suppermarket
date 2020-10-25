<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function saleProduct()
    {
        return $this->hasMany(SaleProduct::class);
    }
}
