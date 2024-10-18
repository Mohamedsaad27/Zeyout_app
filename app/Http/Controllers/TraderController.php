<?php

namespace App\Http\Controllers;

use App\Interfaces\TraderRepositoryInterface;
use App\Traits\HandleApiResponse;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    protected $traderRepository;
    public function __construct(TraderRepositoryInterface $traderRepositoryInterface)
    {
        $this->traderRepository = $traderRepositoryInterface;
    }

    public function getTrades(Request $request){
        return $this->traderRepository->getTraders($request);
    }

    
    public function getTraderDetails($id){
        return $this->traderRepository->getTraderDetails($id);
    }

    public function searchOnTraders($searchTerm){
        return $this->traderRepository->searchOnTraders($searchTerm);
    }
}
