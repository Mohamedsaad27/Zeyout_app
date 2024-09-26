<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BrandRepositoryInterface;

class BrandController extends Controller
{
    protected $brandRepository;
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAllBrands()
    {
        return $this->brandRepository->getAllBrands();
    }

    public function getBrandById($brandId)
    {
        return $this->brandRepository->getBrandById($brandId);
    }
}
