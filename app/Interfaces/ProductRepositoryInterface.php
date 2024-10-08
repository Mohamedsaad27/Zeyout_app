<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{   
    public function getAllProducts();
    public function getProductById($productId);
    public function filterProducts(Request $request);
    public function getRegions();
}
