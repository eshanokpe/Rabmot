<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('broadcast_deliveries', function (Blueprint $table) {
            $table->string('recipient_phone')->nullable()->after('recipient_email');
        });
    }

    public function down()
    {
        Schema::table('broadcast_deliveries', function (Blueprint $table) {
            $table->dropColumn('recipient_phone');
        });
    }
};
