<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('raw_material_id')->references('id')->on('raw_materials')->onDelete('set null');
            $table->foreignId('assigned_by')->nullable()->references('id')->on('admins')->onDelete('set null');
            $table->boolean('current')->default(false);
            $table->timestamp('assigned_at')->nullable();
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
        Schema::dropIfExists('region_users');
    }
}
