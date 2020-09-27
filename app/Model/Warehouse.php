<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable =  ['month','year','begin_inventory','end_inventory','sum_import','sum_export'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
