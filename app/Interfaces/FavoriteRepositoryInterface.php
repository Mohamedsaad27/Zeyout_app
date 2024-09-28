<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface FavoriteRepositoryInterface
{
    public function addProductToFavorite(Request $request);
    public function RemoveProductFromFavorite(Request $request);

    public function getFavoriteProducts(Request $request);
}
