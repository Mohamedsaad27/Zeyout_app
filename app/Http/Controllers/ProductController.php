<?php

namespace App\Http\Controllers;

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
        $filters = [
            'category_name_en' => $request->query('category_name_en'),
            'brand_name_en'    => $request->query('brand_name_en'),
            'size'             => $request->query('size'),
            'mileage'          => $request->query('mileage'),
            'API'              => $request->query('API'),
            'min_price'        => $request->query('min_price'),
            'max_price'        => $request->query('max_price'),
        ];
        return $this->productRepository->filterProducts($filters);
    }

}

