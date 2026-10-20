<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('broadcast_deliveries') || Schema::hasColumn('broadcast_deliveries', 'recipient_phone')) {
            return;
        }

        Schema::table('broadcast_deliveries', function (Blueprint $table) {
            $table->string('recipient_phone')->nullable()->after('recipient_email');
        });
    }

    public function down()
    {
        if (!Schema::hasTable('broadcast_deliveries') || !Schema::hasColumn('broadcast_deliveries', 'recipient_phone')) {
            return;
        }

        Schema::table('broadcast_deliveries', function (Blueprint $table) {
            $table->dropColumn('recipient_phone');
        });
    }
};
