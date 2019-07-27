<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'category_group_id'];
    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class);
    }
    public function categoryType()
    {
        return $this->hasMany(CategoryType::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
