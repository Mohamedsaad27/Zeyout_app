<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'description_ar', 'description_en', 'image', 'API', 'trader_id', 'brand_id'];

    public function scopeFilter($query, $request)
    {
        return $query->when($request->query('category_name_en'), function ($query, $category) {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('name_en', $category);
            });
            })
            ->when($request->query('brand_name_en'), function ($query, $brand) {
                $query->whereHas('brand', function ($q) use ($brand) {
                    $q->where('name_en', $brand);
                });
            })
            ->when($request->query('size'), function ($query, $size) {
                $query->whereHas('product_variants', function ($q) use ($size) {
                    $q->where('size', $size);
                });
            })
            ->when($request->query('mileage'), function ($query, $mileage) {
                $query->whereHas('product_variants', function ($q) use ($mileage) {
                    $q->where('mileage', $mileage);
                });
            })
            ->when($request->query('API'), function ($query, $API) {
                $query->where('API', $API);
            })
            ->when($request->query('min_price'), function ($query, $minPrice) {
                $query->whereHas('product_variants', function ($q) use ($minPrice) {
                    $q->where('unit_price', '>=', $minPrice);
                });
            })
            ->when($request->query('max_price'), function ($query, $maxPrice) {
                $query->whereHas('product_variants', function ($q) use ($maxPrice) {
                    $q->where('unit_price', '<=', $maxPrice);
                });
            });
    }
    public function scopeSearch($query, $request)
    {
        return  $query->when($request->query('name_en'), function ($query, $search) {
            $query->where('name_en', 'like', '%' . $search . '%')
                  ->orWhere('name_ar', 'like', '%' . $search . '%');
        });
    }
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
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }
}