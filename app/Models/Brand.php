<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','logo'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getLogoAttribute($value)
    {
        return $value ? asset('storage/brands/' . $value) : null;
    }

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = $value->store('brands', 'public');
    }
}
