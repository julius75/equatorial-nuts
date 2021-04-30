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
            $table->string('ref_number')->unique()->index();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('farmer_id')->references('id')->on('farmers')->onDelete('restrict');
            $table->foreignId('price_list_id')->references('id')->on('price_lists')->onDelete('restrict');
            $table->decimal('amount', 8, 2)->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('disbursed')->default(false);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('disbursed_at')->nullable();
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
