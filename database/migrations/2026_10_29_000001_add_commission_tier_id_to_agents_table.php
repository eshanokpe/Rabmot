<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('agents', 'commission_tier_id')) {
            Schema::table('agents', function (Blueprint $table) {
                $table->foreignId('commission_tier_id')
                    ->nullable()
                    ->after('commission_override_rate')
                    ->constrained('agent_commission_tiers')
                    ->nullOnDelete();
            });
        }
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('commission_tier_id');
        });
    }
};
