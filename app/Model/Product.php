<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }
    public function categoryType()
    {
        return $this->belongsTo(categoryType::class);
    }
    public function album()
    {
        return $this->hasMany(Album::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}