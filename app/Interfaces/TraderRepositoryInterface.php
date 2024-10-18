<?php

namespace App\Interfaces;
use Illuminate\Http\Request;
interface TraderRepositoryInterface
{
    public function getTraders(Request $request);
    public function getTraderDetails($id);
    public function searchOnTraders($searchTerm);    
}

