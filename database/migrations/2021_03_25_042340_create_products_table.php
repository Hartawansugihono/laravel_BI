<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->integer('price')->default(0);
            $table->integer('amount')->default(0);
            $table->integer('qty')->default(0);
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')
            ->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
