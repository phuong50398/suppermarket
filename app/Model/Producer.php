<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
        $this->attributes['code'] = firstchars($value);
    }
}
