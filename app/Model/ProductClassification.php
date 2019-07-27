<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductClassification extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function classify()
    {
        return $this->belongsTo(Classify::class);
    }
}
