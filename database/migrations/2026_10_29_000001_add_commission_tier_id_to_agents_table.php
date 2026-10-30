<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function foreignKeyExists(): bool
    {
        if (DB::getDriverName() === 'sqlite') {
            foreach (DB::select("PRAGMA foreign_key_list('agents')") as $foreignKey) {
                if (
                    $foreignKey->from === 'commission_tier_id'
                    && $foreignKey->table === 'agent_commission_tiers'
                    && $foreignKey->to === 'id'
                ) {
                    return true;
                }
            }

            return false;
        }

        $result = DB::select(
            "SELECT COUNT(1) as cnt FROM information_schema.key_column_usage
             WHERE table_schema = DATABASE()
             AND table_name = 'agents'
             AND column_name = 'commission_tier_id'
             AND referenced_table_name = 'agent_commission_tiers'
             AND referenced_column_name = 'id'"
        );

        return (int) ($result[0]->cnt ?? 0) > 0;
    }

    public function up()
    {
        if (!Schema::hasTable('agents') || !Schema::hasTable('agent_commission_tiers')) {
            throw new \RuntimeException('The agents and agent_commission_tiers tables must exist before assigning commission tiers.');
        }

        if (! Schema::hasColumn('agents', 'commission_tier_id')) {
            Schema::table('agents', function (Blueprint $table) {
                $table->unsignedBigInteger('commission_tier_id')
                    ->nullable()
                    ->after('commission_override_rate');
            });
        }

        if (!$this->foreignKeyExists()) {
            Schema::table('agents', function (Blueprint $table) {
                $table->foreign('commission_tier_id')
                    ->references('id')
                    ->on('agent_commission_tiers')
                    ->nullOnDelete();
            });
        }
    }

    public function down()
    {
        if (!Schema::hasTable('agents')) {
            return;
        }

        if ($this->foreignKeyExists()) {
            Schema::table('agents', function (Blueprint $table) {
                $table->dropForeign(['commission_tier_id']);
            });
        }

        if (Schema::hasColumn('agents', 'commission_tier_id')) {
            Schema::table('agents', function (Blueprint $table) {
                $table->dropColumn('commission_tier_id');
            });
        }
    }
};
