<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','description_ar','description_en','image','API','trader_id','brand_id'];
    public function trader()
    {
        return $this->belongsTo(Trader::class);
    }
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/products/' . $value) : null;
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value->store('products', 'public');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class,'product_categories','product_id','category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function relatedProducts(){
        return $this->belongsToMany(Product::class,'related_products','product_id','related_product_id');
    }
   
}
