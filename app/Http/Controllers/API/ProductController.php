<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::simplePaginate(15);

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $product = Product::findOrFail($id);

            return $product;
        }
        catch(Exception $e){
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $product = Product::findOrFail($id);

            $product->update($request->all());

            return $product;
        }
        catch(Exception $e){
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::findOrFail($id);

            $product->status = 'trash';
            $product->save();

            return response()->json(['message' => 'Status do produto atualizado com sucesso!'], 204);
        }
        catch(Exception $e){
            return response()->json(['message' => 'Erro ao alterar status do produto!'], 404);
        }
    }
}
