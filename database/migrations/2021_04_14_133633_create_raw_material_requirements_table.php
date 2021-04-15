<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_material_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raw_material_id')
                ->references('id')
                ->on('raw_materials')
                ->onDelete('restrict');
            $table->string('parameter');
            $table->string('type');
            $table->enum('value',['MIN', 'MAX', null])->nullable();
            $table->string('requirement');
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('raw_material_requirements');
    }
}
