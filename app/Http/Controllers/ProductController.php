<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getAllProducts(){
        return $this->productRepository->getAllProducts();
    }
    public function getProductById($productId){
        return $this->productRepository->getProductById($productId);
    }
    public function filterProducts(Request $request)
    {
        return $this->productRepository->filterProducts($request);
    }
}

