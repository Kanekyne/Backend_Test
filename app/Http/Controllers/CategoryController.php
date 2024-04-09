<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return response()->json([
            'message' => "Categoria creada exitosamente",
            'category' => $category
        ], Response::HTTP_CREATED);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeCategoryRequest $request, $category)
    {
        $category=Category::find($category);
        $category->update($request->only('name', 'description'));
        return response()->json([
            'message'=>"La categoria ha sido actualizada",
            'category'=>$category,
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $category=Category::find($category);
        $category->delete();
        return response()->json([
            'message'=>"La categoria fue elminida con exito"
        ], Response::HTTP_OK);
    }
}
