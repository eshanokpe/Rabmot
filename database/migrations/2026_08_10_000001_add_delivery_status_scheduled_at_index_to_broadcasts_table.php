<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private function indexExists(string $table, string $indexName): bool
    {
        $result = DB::select(
            "SELECT COUNT(1) as cnt FROM information_schema.statistics
             WHERE table_schema = DATABASE()
             AND table_name = ?
             AND index_name = ?",
            [$table, $indexName]
        );

        return $result[0]->cnt > 0;
    }

    public function up()
    {
        $indexName = 'broadcasts_delivery_status_scheduled_at_index';

        if (! $this->indexExists('broadcasts', $indexName)) {
            Schema::table('broadcasts', function (Blueprint $table) use ($indexName) {
                $table->index(['delivery_status', 'scheduled_at'], $indexName);
            });
        }
    }

    public function down()
    {
        Schema::table('broadcasts', function (Blueprint $table) {
            try { $table->dropIndex('broadcasts_delivery_status_scheduled_at_index'); } catch (\Exception $e) {}
        });
    }
};
