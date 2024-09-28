<?php

namespace App\Http\Controllers;

use App\Interfaces\FavoriteRepositoryInterface;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
   protected $favoriteRepository;
   public function __construct(FavoriteRepositoryInterface $favoriteRepository){
       $this->favoriteRepository = $favoriteRepository;
   }

    public function addProductToFavorite(Request $request){
       return $this->favoriteRepository->addProductToFavorite($request);
    }
    public function RemoveProductFromFavorite(Request $request){
       return $this->favoriteRepository->RemoveProductFromFavorite($request);
    }

    public function getFavoriteProducts(Request $request){
       return $this->favoriteRepository->getFavoriteProducts($request);
    }
}
