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
            $table->string('brand_code', 100)->nullable();
            $table->string('brand_code_format', 100)->nullable();
            $table->string('ubrand_code', 100)->nullable();
            $table->string('name', 255)->nullable();
            $table->double('price', 12, 2)->default(0);
            $table->double('price_buy', 12, 2)->default(0);
            $table->double('price_tax', 12,2)->default(0);
            $table->double('weight', 12, 2)->default(0);
            $table->string('vendor', 100)->nullable();
            $table->string('origin', 200)->nullable();
            $table->double('point', 12, 2)->default(0);
            $table->string('stock')->nullable();
            $table->string('image_big', 255)->nullable();
            $table->string('image_small', 255)->nullable();
            $table->string('is_display',  10)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
