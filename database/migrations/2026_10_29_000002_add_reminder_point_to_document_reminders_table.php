<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Which automatic reminder point (30/15/7/1 days, 0 = expired) an automatic
    // email was for, so each point is only emailed once per expiry date.
    public function up()
    {
        if (!Schema::hasTable('document_reminders') || Schema::hasColumn('document_reminders', 'reminder_point')) {
            return;
        }

        Schema::table('document_reminders', function (Blueprint $table) {
            $table->smallInteger('reminder_point')->nullable()->after('status');
        });
    }

    public function down()
    {
        if (!Schema::hasTable('document_reminders') || !Schema::hasColumn('document_reminders', 'reminder_point')) {
            return;
        }

        Schema::table('document_reminders', function (Blueprint $table) {
            $table->dropColumn('reminder_point');
        });
    }
};
