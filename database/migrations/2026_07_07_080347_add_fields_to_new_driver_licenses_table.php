<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('new_driver_licenses', function (Blueprint $table) {
            $table->string('facialmark')->nullable();
            $table->string('glasses')->nullable();
            $table->string('disability')->nullable();
        });
    }

    public function down()
    {
        Schema::table('new_driver_licenses', function (Blueprint $table) {
            $table->dropColumn(['facialmark', 'glasses', 'disability']);
        });
    }
};