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
            $table->foreignId('brand_id')->nullable()->constrained('brands');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('child_category_id')->nullable()->constrained('child_categories');
            $table->foreignId('sub_child_category_id')->nullable()->constrained('sub_child_categories');
            $table->string('product_name',150);
            $table->string('slug',150);
            $table->string('product_code',50)->nullable();
            $table->string('color',50)->nullable();
            $table->decimal('e_money',15,2)->nullable();
            $table->decimal('indoor_charge',15,2)->nullable();
            $table->decimal('outdoor_charge',15,2)->nullable();
            $table->text('description')->nullable();
            $table->decimal('total_price',15,2)->nullable();
            $table->string('shipp_des',150)->nullable();
            $table->boolean('status')->default(1);
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
