<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function children()
{
    return $this->hasMany(Category::class, 'parent_id');
}
public function parent()
{
    return $this->belongsTo(Category::class, 'parent_id');
}
public function show(Category $category)
{
    return $category->load('children');
}

}
