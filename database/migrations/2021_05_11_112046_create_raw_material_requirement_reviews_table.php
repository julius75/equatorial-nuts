<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialRequirementReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_material_requirement_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('restrict');
            $table->foreignId('raw_material_requirement_submission_id')->references('id')->on('raw_material_requirement_submissions')->onDelete('restrict');
            $table->foreignId('admin_id')->comment('id of the logged in user who submitted the review')->nullable()->references('id')->on('admins')->onDelete('set null');
            $table->string('value');
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
        Schema::dropIfExists('raw_material_requirement_reviews');
    }
}
