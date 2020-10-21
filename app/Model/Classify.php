<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{
    public function productClassify()
    {
        return $this->hasMany(ProductClassification::class);
    }
   
}
