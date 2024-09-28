<?php

namespace App\Repositories;

use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    use HandleApiResponse;

    public function addProductToFavorite(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_id' => ['required', 'integer', 'exists:products,id']
            ]);
            $existingFavorite = Favorite::where([
                ['user_id', Auth::id()],
                ['product_id', $validatedData['product_id']]
            ])->first();
            if ($existingFavorite) {
                return $this->errorResponse(trans('messages.product_already_in_favorite'), 409);
            }
            DB::transaction(function () use ($validatedData) {
                Favorite::create([
                    'user_id' => Auth::id(),
                    'product_id' => $validatedData['product_id']
                ]);
            });
            return $this->successResponse([], trans('messages.product_added_to_favorite'), 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function removeProductFromFavorite(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_id' => ['required', 'integer', 'exists:favorites,product_id,user_id,' . Auth::id()]
            ]);

            $favorite = Favorite::where('user_id', Auth::id())
                ->where('product_id', $validatedData['product_id'])
                ->first();

            if ($favorite) {
                $favorite->delete();
                return $this->successResponse([], trans('messages.product_removed_from_favorite'), 200);
            } else {
                return $this->errorResponse(trans('messages.product_not_in_favorite'), 404);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function getFavoriteProducts(Request $request)
    {
        try {
            $favorites = Favorite::with('product')
                ->where('user_id', Auth::id())
                ->get();

            return $this->successResponse(FavoriteResource::collection($favorites), trans('messages.favorites_list'), 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
