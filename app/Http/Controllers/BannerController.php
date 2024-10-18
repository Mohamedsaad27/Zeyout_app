<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BannerRepositoryInterface;

class BannerController extends Controller
{
    private $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
         return $this->bannerRepository->index();
    }
}
