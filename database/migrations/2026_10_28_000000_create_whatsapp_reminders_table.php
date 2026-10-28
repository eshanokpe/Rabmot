<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('whatsapp_reminders')) {
            return;
        }

        Schema::create('whatsapp_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_renewal_id');
            $table->string('document_field');
            $table->date('expiry_date');
            $table->string('recipient_phone');
            $table->text('message');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('admin_name')->nullable();
            $table->timestamps();

            $table->index(['vehicle_renewal_id', 'document_field']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('whatsapp_reminders');
    }
};
