<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreignId('raw_material_id')->references('id')->on('raw_materials')->onDelete('cascade');
            $table->double('amount', 8,0);
            $table->integer('value')->default(1);
            $table->string('unit')->default('kg');
            $table->date('date');
            $table->foreignId('created_by')->nullable()->references('id')->on('admins')->onDelete('set null');
            $table->foreignId('approved_by')->nullable()->references('id')->on('admins')->onDelete('set null');
            $table->boolean('approved')->default(false);
            $table->boolean('current')->default(false);
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('price_lists');
    }
}
