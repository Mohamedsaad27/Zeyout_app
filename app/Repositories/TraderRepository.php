<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponse;
use App\Http\Resources\UserResource;
use App\Http\Resources\TraderResource;
use App\Http\Resources\SingleTraderResource;
use App\Interfaces\TraderRepositoryInterface;

class TraderRepository implements TraderRepositoryInterface
{
    use HandleApiResponse;
    public function getTraders(Request $request)
    {
        try {
            $traders = Trader::with('user','governate')
                ->when($request->query('governate'), function ($query, $governate) {
                    return $query->where('governate_id', $governate);
                })
                ->when($request->query('category'), function ($query, $category) {
                    return $query->where('category_id', $category);
                })
                ->when($request->query('name'), function ($query, $name) {
                    return $query->whereHas('user', function ($q) use ($name) {
                        $q->Where('user_name', 'like', '%' . $name . '%');
                    });
                })
                ->paginate(15);
            if($traders->isEmpty()){
                return $this->errorResponse(trans('messages.no_traders'), 404);
            }
            return $this->successResponse(TraderResource::collection($traders), trans('messages.trades_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function getTraderDetails($traderId)
    {
        try {
            $trader = Trader::with('user','governate','products')
                ->find($traderId);
            if(!$trader){
                return $this->errorResponse(trans('messages.trader_not_found'), 404);
            }
            return $this->successResponse(new SingleTraderResource($trader), trans('messages.trader_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    

}
