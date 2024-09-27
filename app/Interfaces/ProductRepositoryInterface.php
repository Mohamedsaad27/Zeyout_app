<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{   
    public function getAllProducts();
    public function getProductById($productId);
}
