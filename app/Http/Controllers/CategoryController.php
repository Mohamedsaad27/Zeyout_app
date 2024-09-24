<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->index();
    }

    public function store(Request $request)
    {
        return $this->categoryRepository->store($request);
    }

    public function update(Request $request, Category $category)
    {
        return $this->categoryRepository->update($request, $category);
    }

    public function destroy(Category $category)
    {
        return $this->categoryRepository->destroy($category);
    }
}
