<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectedWeightToOrderRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_raw_materials', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('set null');
            $table->decimal('accepted_gross_weight',8,4)->nullable();
            $table->decimal('accepted_net_weight', 8,4)->nullable();
            $table->decimal('rejected_gross_weight', 8,4)->nullable();
            $table->decimal('rejected_net_weight', 8,4)->nullable();
            $table->boolean('weight_reviewed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_raw_materials', function (Blueprint $table) {
            $table->dropColumn('admin_id');
            $table->dropColumn('accepted_gross_weight');
            $table->dropColumn('accepted_net_weight');
            $table->dropColumn('rejected_gross_weight');
            $table->dropColumn('rejected_net_weight');
            $table->dropColumn('weight_reviewed');
        });
    }
}
