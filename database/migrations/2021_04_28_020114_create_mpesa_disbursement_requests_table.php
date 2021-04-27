<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaDisbursementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_disbursement_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('restrict');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->string('ConversationID')->index();
            $table->string('OriginatorConversationID')->index();
            $table->string('ResponseCode');
            $table->string('ResponseDescription');
            $table->boolean('issued')->default(false);
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
        Schema::dropIfExists('mpesa_disbursement_requests');
    }
}
