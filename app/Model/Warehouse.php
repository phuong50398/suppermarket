<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable =  ['thang','nam','tondau','toncuoi','tongnhap','tongxuat'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
