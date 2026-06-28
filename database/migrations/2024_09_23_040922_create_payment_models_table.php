<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_models', function (Blueprint $table) {
            $table->id();
            $table->string('process_id')->nullable();
            $table->string('process_type')->nullable();
            $table->string('paymentReference')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->double('amount', 10, 2)->nullable();
            $table->string('trans_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_models');
    }
};
