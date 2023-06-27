<?php

namespace App\Console\Commands;

use App\Models\APIStatus;
use App\Models\Product;
use Exception;
use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para importar os dados da API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            for($i = 1; $i <= 9; $i ++){
                $arquivo = gzopen("https://challenges.coode.sh/food/data/json/products_0$i.json.gz", 'r');

                $json_data = array();

                
                for ($j = 0; $j < 100; $j++) {
                    $line = gzgets($arquivo);
                    if ($line === false) {
                        break;
                    }
                    array_push($json_data, $line);
                }

                gzclose($arquivo);

                $arquivoFormatado = str_replace(['"\\', '\r', ';;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;'], '', $json_data);

                foreach($arquivoFormatado as $data){
                    $productData = json_decode($data, true);
        
                    Product::updateOrCreate(
                        [
                            'code' => $productData['code']
                        ],
                        [
                            'status'           => "published",
                            'imported_t'       => date("Y-m-d H:i:s"),
                            'url'              => !empty($productData['url']) ?? null,
                            'creator'          => !empty($productData['creator']) ?? null,
                            'created_t'        => !empty($productData['created_t']) ?? null,
                            'last_modified_t'  => !empty($productData['last_modified_t']) ?? null,
                            'product_name'     => !empty($productData['product_name']) ?? null,
                            'quantity'         => !empty($productData['quantity']) ?? null,
                            'brands'           => !empty($productData['brands']) ?? null,
                            'categories'       => !empty($productData['categories']) ?? null,
                            'labels'           => !empty($productData['labels']) ?? null,
                            'cities'           => !empty($productData['cities']) ?? null,
                            'purchase_places'  => !empty($productData['purchase_places']) ?? null,
                            'stores'           => !empty($productData['stores']) ?? null,
                            'ingredients_text' => !empty($productData['ingredients_text']) ?? null,
                            'traces'           => !empty($productData['traces']) ?? null,
                            'serving_size'     => !empty($productData['serving_size']) ?? null,
                            'serving_quantity' => !empty($productData['serving_quantity']) ?? null,
                            'nutriscore_score' => !empty($productData['nutriscore_score']) ?? null,
                            'nutriscore_grade' => !empty($productData['nutriscore_grade']) ?? null,
                            'main_category'    => !empty($productData['main_category']) ?? null,
                            'image_url'        => !empty($productData['image_url']) ?? null
                        ]
                    );
                }
            }

            $status = 'Dados inseridos/atualizados com sucesso!';

        } catch(Exception $e){
            $status = 'Erro ao inserir os dados!';
            echo $e->getMessage();
        }

        $memoryConsumed = round(memory_get_usage() / 1024) . 'KB';

        APIStatus::create(
            [
                'status'         => $status,
                'memoryConsumed' => $memoryConsumed,
                'date'           => date("Y-m-d H:i:s")
            ]
        );
    }
}
