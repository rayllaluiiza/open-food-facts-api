<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('code');
            $table->enum('ststus', ['draft', 'trash', 'published']);
            $table->dateTime('imported_t');
            $table->string('url', 255);
            $table->string('creator', 20);
            $table->integer('created_t');
            $table->integer('last_modified_t');
            $table->string('product_name', 100);
            $table->string('quantity', 50);
            $table->string('brands', 255);
            $table->string('categories', 255);
            $table->string('labels', 100);
            $table->string('cities', 50)->nullable();
            $table->string('purchase_places', 100);
            $table->string('stores', 50);
            $table->string('ingredients_text', 255);
            $table->string('traces', 100);
            $table->string('serving_size', 60);
            $table->float('serving_quantity', 8, 2);
            $table->integer('nutriscore_score');
            $table->string('nutriscore_grade', 1);
            $table->string('main_category', 50);
            $table->string('image_url', 255);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
