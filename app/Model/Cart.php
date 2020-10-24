<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class);
    }
}
