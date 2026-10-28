<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('broadcast_deliveries') || Schema::hasColumn('broadcast_deliveries', 'sent_by_admin_id')) {
            return;
        }

        // Who opened the WhatsApp chat for a manually-sent WhatsApp delivery.
        Schema::table('broadcast_deliveries', function (Blueprint $table) {
            $table->unsignedBigInteger('sent_by_admin_id')->nullable()->after('delivered_at');
            $table->string('sent_by_admin_name')->nullable()->after('sent_by_admin_id');
        });
    }

    public function down()
    {
        if (!Schema::hasTable('broadcast_deliveries') || !Schema::hasColumn('broadcast_deliveries', 'sent_by_admin_id')) {
            return;
        }

        Schema::table('broadcast_deliveries', function (Blueprint $table) {
            $table->dropColumn(['sent_by_admin_id', 'sent_by_admin_name']);
        });
    }
};
