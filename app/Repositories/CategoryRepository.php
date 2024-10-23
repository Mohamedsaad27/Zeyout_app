<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\HandleImages;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SingleCategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository implements CategoryRepositoryInterface
{
    use HandleApiResponse, HandleImages;
    public function index(){
        try{
            $categories = DB::table('categories')->get();
            if($categories->isEmpty()){
                return $this->errorResponse(trans('messages.no_categories_found'), 404);
            }
            return $this->successResponse(CategoryResource::collection($categories), trans('messages.categories_retrieved_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function store(Request $request){
        try{
            $data = $request->validate([
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
           $this->handleImages($request);
            $categoryId = DB::table('categories')->insertGetId($data);
            $category = DB::table('categories')->find($categoryId);
            if (!$category) {
                return $this->errorResponse(trans('messages.category_creation_failed'), 500);
            }
            return $this->successResponse(new CategoryResource($category), trans('messages.category_created_successfully'), 201);
        }catch(\Exception $e){
            return $this->errorResponse(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, Category $category){
        try {
            $data = $request->validate([
                'name_ar' => 'sometimes|required|string|max:255',
                'name_en' => 'sometimes|required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $this->handleImages($request);
            $category->update($data);
            return $this->successResponse(new CategoryResource($category), trans('messages.category_updated_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function destroy(Category $category){
        try{
            $category->delete();
            return $this->successResponse(null, trans('messages.category_deleted_successfully'), 200);
        }catch(ModelNotFoundException $e){
            return $this->errorResponse(trans('messages.category_not_found'), 404);
        }
        catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function handleImages(Request $request){
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/categories';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
            $data['logo'] = $imagePath . '/' . $imageName;
        }
    }
    public function getCategoryById($categoryId){
        $category = Category::with('products')->find($categoryId);
        if(!$category){
            return $this->errorResponse(trans('messages.category_not_found'), 404);
        }
        return $this->successResponse(new SingleCategoryResource($category), trans('messages.category_retrieved_successfully'), 200);
    }
}
