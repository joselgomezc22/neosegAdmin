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
            $table->string('ref')->nullable();
            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->string('provider')->nullable();
            $table->string('notes')->nullable();
            $table->integer('category')->nullable();
            $table->integer('product_key')->nullable();
            $table->integer('unit_sale_key')->nullable();
            $table->string('description')->nullable();
            $table->float('sale_price',10,3)->nullable();
            $table->bigInteger('bar_code')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
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
