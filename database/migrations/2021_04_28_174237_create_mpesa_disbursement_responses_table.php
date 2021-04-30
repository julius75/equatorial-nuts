<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaDisbursementResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_disbursement_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('restrict');
            $table->string('OriginatorConversationID')->nullable()->index();
            $table->string('ConversationID')->nullable()->index();
            $table->string('TransactionID')->nullable();
            $table->decimal('TransactionAmount', 8,2)->nullable();
            $table->string('TransactionReceipt')->nullable();
            $table->string('B2CRecipientIsRegisteredCustomer')->nullable();
            $table->boolean('issued')->default(false);
            $table->json('response')->nullable();
            $table->string('ResultCode')->nullable();
            $table->string('ResultDesc')->nullable();
            $table->string('B2CChargesPaidAccountAvailableFunds')->nullable();
            $table->string('ReceiverPartyPublicName')->nullable();
            $table->dateTime('TransactionCompletedDateTime')->nullable();
            $table->string('B2CUtilityAccountAvailableFunds')->nullable();
            $table->string('B2CWorkingAccountAvailableFunds')->nullable();
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
        Schema::dropIfExists('mpesa_disbursement_responses');
    }
}
