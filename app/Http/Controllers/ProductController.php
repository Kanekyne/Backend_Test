<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json([
            'message' => "El producto fue creado exitosamente",
            'product' => $product,
        ], Response::HTTP_CREATED);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product)
    {
        $product = Product::find($product);
        $product->update($request->validated());
        return response()->json([
            'message' => "El producto ha sido actualizada",
            'product' => $product,
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $product = Product::find($product);
        $product->delete();
        return response()->json([
            'message' => "El producto fue elminido con exito"
        ], Response::HTTP_OK);
    }



    public function quantity($category)
    {
        $total = Product::whereHas('category', function ($query) use ($category) {
            $query->where('category_id', $category);
        })->sum('quantity');

        return response()->json(['total' => $total]);

    }


    public function quantity_name($categoryName)
    {
        $categoria = Category::where('name', $categoryName)->first();
        if ($categoria) {
            $total = Product::where('category_id', $categoria->id)->sum('quantity');
            $i = Category::where('name', $categoryName);
            echo "El ID de la categoría $categoryName es: {$categoria->id}" . "\n";
            return response()->json(['total' => $total]);
        } else {
            dd($categoria);
        }
    }
}



