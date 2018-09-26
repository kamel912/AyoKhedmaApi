<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return CategoriesResource::collection(Category::all());
    }

    public function limited($limit)
    {
        return Category::limit($limit)->get();
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return response()->json($category);
    }

    public function delete(Category $category)
    {

        $category->delete();


        return response()->json(['message' => 'Category deleted']);
    }
}
