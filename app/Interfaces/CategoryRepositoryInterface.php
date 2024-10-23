<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function index();
    public function store(Request $request);
    public function getCategoryById($categoryId);
    public function update(Request $request, Category $category);
    public function destroy(Category $category);
}
