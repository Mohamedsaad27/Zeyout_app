<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    public function getAllBrands();
    public function getBrandById($brandId);
}
