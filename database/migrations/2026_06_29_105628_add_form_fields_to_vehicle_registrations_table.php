<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vehicle_registrations', function (Blueprint $table) {
            $table->string('fullname')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('lga')->nullable();
            $table->string('state')->default('Lagos');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('nin', 11)->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('doc_custom_papers')->nullable();
            $table->string('doc_chassis_photo')->nullable();
            $table->string('doc_nin_slip')->nullable();
            $table->string('doc_address_proof')->nullable();
            $table->string('status')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('vehicle_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'fullname', 'gender', 'marital_status', 'dob', 'address', 'lga', 'state',
                'phone', 'email', 'nin', 'chassis_number', 'engine_number', 'vehicle_make',
                'vehicle_model', 'year', 'color', 'fuel_type', 'doc_custom_papers',
                'doc_chassis_photo', 'doc_nin_slip', 'doc_address_proof', 'status'
            ]);
        });
    }
};