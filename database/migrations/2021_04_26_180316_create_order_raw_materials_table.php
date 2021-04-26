<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('raw_material_id')->references('id')->on('raw_materials')->onDelete('restrict');
            $table->foreignId('bag_type_id')->nullable()->references('id')->on('bag_types')->onDelete('set null');
            $table->integer('bags');
            $table->decimal('gross_weight',8,4);
            $table->decimal('net_weight', 8,4);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_raw_materials');
    }
}
