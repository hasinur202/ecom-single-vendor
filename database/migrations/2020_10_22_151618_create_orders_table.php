<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->decimal('amount');
            $table->decimal('total_emoney')->nullable();
            $table->string('address');
            $table->string('delivery_status')->default('pending');
            $table->string('status');
            $table->string('transaction_id');
            $table->string('currency');
            $table->string('payment',150)->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
