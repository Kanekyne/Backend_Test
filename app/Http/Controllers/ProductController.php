<?php

namespace App\Http\Controllers;

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
        $product = Product::create($request->all());
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
        $product=Product::find($product);
        $product->update($request->only('name', 'description'));
        return response()->json([
            'message'=>"El producto ha sido actualizada",
            'category'=>$product,
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $product=Product::find($product);
        $product->delete();
        return response()->json([
            'message'=>"El producto fue elminido con exito"
        ], Response::HTTP_OK);
    }

}
