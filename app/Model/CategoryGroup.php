<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    protected $fillable = ['id', 'name'];
    public function category()
    {
        return $this->hasMany(Category::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
