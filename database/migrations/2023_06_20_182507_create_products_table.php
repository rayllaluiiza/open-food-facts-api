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
            $table->string('code');
            $table->enum('status', ['draft', 'trash', 'published']);
            $table->dateTime('imported_t');
            $table->longText('url')->nullable();
            $table->string('creator', 100)->nullable();
            $table->integer('created_t')->nullable();
            $table->integer('last_modified_t')->nullable();
            $table->string('product_name', 100)->nullable();
            $table->string('quantity', 50)->nullable();
            $table->string('brands', 255)->nullable();
            $table->longText('categories', 255)->nullable();
            $table->string('labels', 255)->nullable();
            $table->string('cities', 50)->nullable()->nullable();
            $table->string('purchase_places', 100)->nullable();
            $table->string('stores', 50)->nullable();
            $table->longText('ingredients_text')->nullable();
            $table->string('traces', 255)->nullable();
            $table->string('serving_size', 60)->nullable();
            $table->float('serving_quantity', 8, 2)->nullable();
            $table->integer('nutriscore_score')->nullable();
            $table->string('nutriscore_grade', 1)->nullable();
            $table->string('main_category', 50)->nullable();
            $table->string('image_url', 255)->nullable();
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
