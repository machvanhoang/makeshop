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
            $table->string('product_id', 255)->nullable();
            $table->string('brand_code', 100)->nullable();
            $table->string('ubrand_code', 100)->nullable();
            $table->string('is_display',  10)->nullable();
            $table->string('is_member_only',  10)->nullable();
            $table->string('product_name', 255)->nullable();
            $table->string('product_page_url', 255)->nullable();
            $table->double('weight', 12, 2)->default(0);
            $table->double('price', 12, 2)->default(0);
            $table->double('price_tax', 12, 2)->default(0);
            $table->tinyInteger('consumption_tax_rate')->default(0);
            $table->string('jancode', 100)->nullable();
            $table->string('vendor', 100)->nullable();
            $table->string('origin', 200)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('is_diplay_stock')->default(0);
            $table->string('zoom_image_url', 255)->nullable();
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
