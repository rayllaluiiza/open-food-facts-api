<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"/produtos"},
     *      summary="Display a listing of the resource and paginate then",
     *      description="Get all products on database",
     *      path="/produtos",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response="200", description="List of products"
     *      )
     * )
     */
    public function index()
    {
        $product = Product::simplePaginate(20);
        $data = $product->toArray();

        return $data['data'];
    }

    /**
     * @OA\Get(
     *      tags={"/produtos"},
     *      summary="Display only one product",
     *      description="Get a product from the database",
     *      path="/produtos/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          description="Product id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", description="Show a product"
     *      )
     * )
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
     * @OA\Delete(
     *      tags={"/produtos"},
     *      summary="Change the product status",
     *      description="Change the product status to 'trash'",
     *      path="/produtos/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          description="Product id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response="204", description="Change the product status"
     *      )
     * )
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
