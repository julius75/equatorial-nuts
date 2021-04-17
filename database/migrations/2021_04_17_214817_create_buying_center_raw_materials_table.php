<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingCenterRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_center_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buying_center_id')->references('id')->on('buying_centers')->onDelete('cascade');
            $table->foreignId('raw_material_id')->references('id')->on('raw_materials')->onDelete('cascade');
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
        Schema::dropIfExists('buying_center_raw_materials');
    }
}
