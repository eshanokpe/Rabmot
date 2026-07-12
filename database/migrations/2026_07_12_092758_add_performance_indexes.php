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

    private function addIndexIfMissing(string $table, array $columns, ?string $indexName = null)
    {
        // Skip if any column in the composite index doesn't exist
        foreach ($columns as $column) {
            if (! Schema::hasColumn($table, $column)) {
                return;
            }
        }

        $indexName = $indexName ?: $table . '_' . implode('_', $columns) . '_index';

        if (! $this->indexExists($table, $indexName)) {
            Schema::table($table, function (Blueprint $blueprint) use ($columns, $indexName) {
                $blueprint->index($columns, $indexName);
            });
        }
    }

    public function up()
    {
        $this->addIndexIfMissing('process_histories', ['status']);
        $this->addIndexIfMissing('process_histories', ['process_type']);
        $this->addIndexIfMissing('process_histories', ['created_at']);
        $this->addIndexIfMissing('process_histories', ['user_id']);

        $this->addIndexIfMissing('vehicle_paper_renewals', ['created_at']);
        $this->addIndexIfMissing('vehicle_paper_renewals', ['user_id']);
        $this->addIndexIfMissing('vehicle_paper_renewals', ['plate_number']); // will be skipped if column doesn't exist

        $this->addIndexIfMissing('notifications', ['notifiable_type', 'notifiable_id', 'read_at']);

        $this->addIndexIfMissing('users', ['status']);
    }

    public function down()
    {
        Schema::table('process_histories', function (Blueprint $table) {
            try { $table->dropIndex(['status']); } catch (\Exception $e) {}
            try { $table->dropIndex(['process_type']); } catch (\Exception $e) {}
            try { $table->dropIndex(['created_at']); } catch (\Exception $e) {}
            try { $table->dropIndex(['user_id']); } catch (\Exception $e) {}
        });

        Schema::table('vehicle_paper_renewals', function (Blueprint $table) {
            try { $table->dropIndex(['created_at']); } catch (\Exception $e) {}
            try { $table->dropIndex(['user_id']); } catch (\Exception $e) {}
            try { $table->dropIndex(['plate_number']); } catch (\Exception $e) {}
        });

        Schema::table('notifications', function (Blueprint $table) {
            try { $table->dropIndex(['notifiable_type', 'notifiable_id', 'read_at']); } catch (\Exception $e) {}
        });

        Schema::table('users', function (Blueprint $table) {
            try { $table->dropIndex(['status']); } catch (\Exception $e) {}
        });
    }
};