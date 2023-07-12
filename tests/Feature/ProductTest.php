<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_if_can_user_list_all_products(): void
    {
        $product = Product::factory(3)->create();

        $response = $this->getJson('/api/produtos');

        $response->assertJsonCount(3);
        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($product){
            $json->hasAll([
                '0.code', 
                '0.status', 
                '0.imported_t',
                '0.url',
                '0.creator',
                '0.created_t',
                '0.last_modified_t',
                '0.product_name',
                '0.quantity',
                '0.brands',
                '0.categories',
                '0.labels',
                '0.cities',
                '0.purchase_places',
                '0.stores',
                '0.ingredients_text',
                '0.traces',
                '0.serving_size',
                '0.serving_quantity',
                '0.nutriscore_score',
                '0.nutriscore_grade',
                '0.main_category',
                '0.image_url'
            ]);

            $json->whereAllType([
                '0.code' => 'string', 
                '0.status' => 'string', 
                '0.imported_t' => 'string',
                '0.url' => 'string',
                '0.creator' => 'string',
                '0.created_t' => 'integer',
                '0.last_modified_t' => 'integer',
                '0.product_name' => 'string',
                '0.quantity' => 'string',
                '0.brands' => 'string',
                '0.categories' => 'string',
                '0.labels' => 'string',
                '0.cities' => 'string',
                '0.purchase_places' => 'string',
                '0.stores' => 'string',
                '0.ingredients_text' => 'string',
                '0.traces' => 'string',
                '0.serving_size' => 'string',
                '0.serving_quantity' => 'integer',
                '0.nutriscore_score' => 'integer',
                '0.nutriscore_grade' => 'string',
                '0.main_category' => 'string',
                '0.image_url' => 'string'
            ]);
            
            $json->whereAll([
                '0.code' => $product[0]->code, 
                '0.status' => $product[0]->status, 
                '0.imported_t' => $product[0]->imported_t,
                '0.url' => $product[0]->url,
                '0.creator' => $product[0]->creator,
                '0.created_t' => $product[0]->created_t,
                '0.last_modified_t' => $product[0]->last_modified_t,
                '0.product_name' => $product[0]->product_name,
                '0.quantity' => $product[0]->quantity,
                '0.brands' => $product[0]->brands,
                '0.categories' => $product[0]->categories,
                '0.labels' => $product[0]->labels,
                '0.cities' => $product[0]->cities,
                '0.purchase_places' => $product[0]->purchase_places,
                '0.stores' => $product[0]->stores,
                '0.ingredients_text' => $product[0]->ingredients_text,
                '0.traces' => $product[0]->traces,
                '0.serving_size' => $product[0]->serving_size,
                '0.serving_quantity' => $product[0]->serving_quantity,
                '0.nutriscore_score' => $product[0]->nutriscore_score,
                '0.nutriscore_grade' => $product[0]->nutriscore_grade,
                '0.main_category' => $product[0]->main_category,
                '0.image_url' => $product[0]->image_url
            ]);
        });
    }

    public function test_if_can_user_list_one_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/produtos/' . $product->code);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($product){
            $json->hasAll([
                'code', 
                'status', 
                'imported_t',
                'url',
                'creator',
                'created_t',
                'last_modified_t',
                'product_name',
                'quantity',
                'brands',
                'categories',
                'labels',
                'cities',
                'purchase_places',
                'stores',
                'ingredients_text',
                'traces',
                'serving_size',
                'serving_quantity',
                'nutriscore_score',
                'nutriscore_grade',
                'main_category',
                'image_url'
            ]);

            $json->whereAllType([
                'code' => 'string', 
                'status' => 'string', 
                'imported_t' => 'string',
                'url' => 'string',
                'creator' => 'string',
                'created_t' => 'integer',
                'last_modified_t' => 'integer',
                'product_name' => 'string',
                'quantity' => 'string',
                'brands' => 'string',
                'categories' => 'string',
                'labels' => 'string',
                'cities' => 'string',
                'purchase_places' => 'string',
                'stores' => 'string',
                'ingredients_text' => 'string',
                'traces' => 'string',
                'serving_size' => 'string',
                'serving_quantity' => 'integer',
                'nutriscore_score' => 'integer',
                'nutriscore_grade' => 'string',
                'main_category' => 'string',
                'image_url' => 'string'
            ]);
            
            $json->whereAll([
                'code' => $product->code, 
                'status' => $product->status, 
                'imported_t' => $product->imported_t,
                'url' => $product->url,
                'creator' => $product->creator,
                'created_t' => $product->created_t,
                'last_modified_t' => $product->last_modified_t,
                'product_name' => $product->product_name,
                'quantity' => $product->quantity,
                'brands' => $product->brands,
                'categories' => $product->categories,
                'labels' => $product->labels,
                'cities' => $product->cities,
                'purchase_places' => $product->purchase_places,
                'stores' => $product->stores,
                'ingredients_text' => $product->ingredients_text,
                'traces' => $product->traces,
                'serving_size' => $product->serving_size,
                'serving_quantity' => $product->serving_quantity,
                'nutriscore_score' => $product->nutriscore_score,
                'nutriscore_grade' => $product->nutriscore_grade,
                'main_category' => $product->main_category,
                'image_url' => $product->image_url
            ]);
        });
    }

    public function test_if_can_user_update_product()
    {
        $product = Product::factory()->create();

        $update = [
            'code' => '25466112', 
            'status' => 'draft', 
            'imported_t' => '2023-07-11 23:18:00',
            'url' => 'http://world-en.openfoodfacts.org/product/0000000000017/vitoria-crackers',
            'creator' => 'kiliweb',
            'created_t' => 1529059080,
            'last_modified_t' => 1561463718,
            'product_name' => 'Chocolate n 2',
            'quantity' => '80 g',
            'brands' => 'Jeff de Bruges',
            'categories' => 'Doces',
            'labels' => 'en:made-in-france',
            'cities' => 'Paris',
            'purchase_places' => 'França',
            'stores' => 'Lidl',
            'ingredients_text' => 'Paln suédois 42,6%: farine de BLÉ, eau, farine de SEIGLE, sucre, huile de colza non hydrogénée',
            'traces' => 'teste 33.4g',
            'serving_size' => '28 g (0.25 cup)',
            'serving_quantity' => 0,
            'nutriscore_score' => 0,
            'nutriscore_grade' => 'd',
            'main_category' => 'en:coconut-pies',
            'image_url' => 'https://static.openfoodfacts.org/images/products/000/000/000/0017/front_fr.4.400.jpg'
        ];

        $response = $this->putJson('/api/produtos/' . $product->code, $update);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($update){
            $json->hasAll([
                'code', 
                'status', 
                'imported_t',
                'url',
                'creator',
                'created_t',
                'last_modified_t',
                'product_name',
                'quantity',
                'brands',
                'categories',
                'labels',
                'cities',
                'purchase_places',
                'stores',
                'ingredients_text',
                'traces',
                'serving_size',
                'serving_quantity',
                'nutriscore_score',
                'nutriscore_grade',
                'main_category',
                'image_url'
            ]);

            $json->whereAllType([
                'code' => 'string', 
                'status' => 'string', 
                'imported_t' => 'string',
                'url' => 'string',
                'creator' => 'string',
                'created_t' => 'integer',
                'last_modified_t' => 'integer',
                'product_name' => 'string',
                'quantity' => 'string',
                'brands' => 'string',
                'categories' => 'string',
                'labels' => 'string',
                'cities' => 'string',
                'purchase_places' => 'string',
                'stores' => 'string',
                'ingredients_text' => 'string',
                'traces' => 'string',
                'serving_size' => 'string',
                'serving_quantity' => 'integer',
                'nutriscore_score' => 'integer',
                'nutriscore_grade' => 'string',
                'main_category' => 'string',
                'image_url' => 'string'
            ]);

            $json->whereAll([
                'code' => $update['code'], 
                'status' => $update['status'], 
                'imported_t' => $update['imported_t'],
                'url' => $update['url'],
                'creator' => $update['creator'],
                'created_t' => $update['created_t'],
                'last_modified_t' => $update['last_modified_t'],
                'product_name' => $update['product_name'],
                'quantity' => $update['quantity'],
                'brands' => $update['brands'],
                'categories' => $update['categories'],
                'labels' => $update['labels'],
                'cities' => $update['cities'],
                'purchase_places' => $update['purchase_places'],
                'stores' => $update['stores'],
                'ingredients_text' => $update['ingredients_text'],
                'traces' => $update['traces'],
                'serving_size' => $update['serving_size'],
                'serving_quantity' => $update['serving_quantity'],
                'nutriscore_score' => $update['nutriscore_score'],
                'nutriscore_grade' => $update['nutriscore_grade'],
                'main_category' => $update['main_category'],
                'image_url' => $update['image_url']
            ]);
        });
    }
}
