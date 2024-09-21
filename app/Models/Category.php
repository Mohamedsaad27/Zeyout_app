<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','logo'];
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_categories','category_id','product_id');
    }
    public function getLogoAttribute($value)
    {
        return $value ? asset('storage/categories/' . $value) : null;
    }

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = $value->store('categories', 'public');
    }
}
