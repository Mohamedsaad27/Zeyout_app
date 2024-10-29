<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;
    protected $fillable = [
        'description_ar',
        'description_en',
        'FacebookURL',
        'InstagramURL',
        'user_id',
        'governate_id',
        'number_of_days',
        'is_active',
        'expires_at',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function governate()
    {
        return $this->belongsTo(Governate::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
