<?php

namespace App\Interfaces;

interface TraderRepositoryInterface
{
    public function getTraders();
    public function getTraderDetails($id);
    public function searchOnTraders($searchTerm);    
    }

