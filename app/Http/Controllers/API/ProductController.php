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
     * @OA\Put(
     *      tags={"/produtos"},
     *      summary="Update a product",
     *      description="Update a product on database",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="string"),
     *              @OA\Property(property="url", type="string"),
     *              @OA\Property(property="product_name", type="string"),
     *              @OA\Property(property="quantity", type="string"),
     *              @OA\Property(property="brands", type="string"),
     *              @OA\Property(property="categories", type="string"),
     *              @OA\Property(property="labels", type="string"),
     *              @OA\Property(property="cities", type="string"),
     *              @OA\Property(property="purchase_places", type="string"),
     *              @OA\Property(property="stores", type="string"),
     *              @OA\Property(property="ingredients_text", type="string"),
     *              @OA\Property(property="traces", type="string"),
     *              @OA\Property(property="serving_size", type="string"),
     *              @OA\Property(property="serving_quantity", type="integer"),
     *              @OA\Property(property="nutriscore_score", type="integer"),
     *              @OA\Property(property="nutriscore_grade", type="string"),
     *              @OA\Property(property="main_category", type="string"),
     *              @OA\Property(property="image_url", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", description="Update a product"
     *      )
     * )
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
