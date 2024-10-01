<?php

namespace App\Repositories;

use App\Models\Trader;
use App\Traits\HandleApiResponse;
use App\Http\Resources\TraderResource;
use App\Http\Resources\UserResource;
use App\Interfaces\TraderRepositoryInterface;
use App\Models\User;

class TraderRepository implements TraderRepositoryInterface
{
    use HandleApiResponse;
    public function getTraders()
    {
        try {
            $traders = User::query()
                ->where('type','trader')
                ->paginate(15);
            if($traders->isEmpty()){
                return $this->errorResponse(trans('messages.no_traders'), 404);
            }
            return $this->successResponse(UserResource::collection($traders), trans('messages.trades_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function getTraderDetails($traderId)
    {
        try {
            $trader = User::query()
            ->where('type','trader')
                ->find($traderId);
            if(!$trader){
                return $this->errorResponse(trans('messages.trader_not_found'), 404);
            }
            return $this->successResponse(new UserResource($trader), trans('messages.trader_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function searchOnTraders($searchTerm){
        echo('saa');
    }

}