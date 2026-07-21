<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('wallet_payments', function (Blueprint $table) {
            $table->enum('type', ['self_rebate', 'referral_commission'])->default('self_rebate')->after('userType');
            $table->unsignedBigInteger('source_agent_id')->nullable()->after('type');
        });
    }

    public function down()
    {
        Schema::table('wallet_payments', function (Blueprint $table) {
            $table->dropColumn(['type', 'source_agent_id']);
        });
    }
};
