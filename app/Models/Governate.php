<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governate extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en'];
    protected $table = 'governates';
    public $hidden = ['created_at', 'updated_at'];
    public function traders()
    {
        return $this->hasMany(Trader::class);
    }
}
