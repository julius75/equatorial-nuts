<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaDisbursementSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_disbursement_settings', function (Blueprint $table) {
            $table->id();
            $table->string('environment')->index();
            $table->string('paybill', 2000)->nullable();
            $table->string('security_credential', 2000)->nullable();
            $table->string('initiator_name', 2000)->nullable();
            $table->string('consumer_key', 2000);
            $table->string('consumer_secret', 2000);
            $table->string('mmf_balance')->nullable();
            $table->string('utility_balance')->nullable();
            $table->timestamp('last_updated_at')->nullable();
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
        Schema::dropIfExists('mpesa_disbursement_settings');
    }
}
