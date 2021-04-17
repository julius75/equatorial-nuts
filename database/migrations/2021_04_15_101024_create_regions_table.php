<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('county_id')->nullable()
                ->references('id')
                ->on('counties')
                ->onDelete('set null');
            $table->foreignId('sub_county_id')->nullable()
                ->references('id')
                ->on('sub_counties')
                ->onDelete('set null');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('buying_centers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()
                ->references('id')
                ->on('regions')
                ->onDelete('cascade');
            $table->string('name');
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
        Schema::dropIfExists('regions');
        Schema::dropIfExists('buying_centers');
    }
}
