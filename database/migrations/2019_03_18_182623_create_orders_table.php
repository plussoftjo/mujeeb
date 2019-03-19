<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('auth');
            $table->integer('user_id');
            $table->string('date')->nullable();
            $table->string('lngLat')->nullable();
            $table->string('des')->nullable();
            $table->string('images')->nullable();
            $table->string('state')->default(0);
            $table->string('type');
            $table->integer('catg_id');
            $table->integer('subcatg_id')->nullable();
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
