<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('process_histories', function (Blueprint $table) {
            // 'status' already exists on this table (integer: 0=pending, 1=ready,
            // 2=in progress, 3=delivered) — NOT re-adding it here, and NOT changing
            // it to a string, since that would break existing dashboard queries
            // that do $statusCounts->get(0), get(1), etc.

            if (! Schema::hasColumn('process_histories', 'estimated_completion_date')) {
                $table->date('estimated_completion_date')->nullable();
            }

            if (! Schema::hasColumn('process_histories', 'internal_admin_notes')) {
                $table->text('internal_admin_notes')->nullable();
            }

            if (! Schema::hasColumn('process_histories', 'assigned_admin_id')) {
                $table->unsignedBigInteger('assigned_admin_id')->nullable();
            }

            if (! Schema::hasColumn('process_histories', 'status_history')) {
                $table->json('status_history')->nullable();
            }
        });

        // Foreign key added separately so it doesn't fail if the column already
        // existed without one, or if the constraint was already added before.
        if (Schema::hasColumn('process_histories', 'assigned_admin_id')) {
            $foreignKeyExists = collect(\Illuminate\Support\Facades\DB::select(
                "SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
                 WHERE TABLE_SCHEMA = DATABASE()
                 AND TABLE_NAME = 'process_histories'
                 AND COLUMN_NAME = 'assigned_admin_id'
                 AND REFERENCED_TABLE_NAME IS NOT NULL"
            ))->isNotEmpty();

            if (! $foreignKeyExists) {
                Schema::table('process_histories', function (Blueprint $table) {
                    $table->foreign('assigned_admin_id')->references('id')->on('admins')->nullOnDelete();
                });
            }
        }
    }

    public function down()
    {
        Schema::table('process_histories', function (Blueprint $table) {
            if (Schema::hasColumn('process_histories', 'assigned_admin_id')) {
                $table->dropForeign(['assigned_admin_id']);
            }
        });

        Schema::table('process_histories', function (Blueprint $table) {
            foreach (['estimated_completion_date', 'internal_admin_notes', 'status_history', 'assigned_admin_id'] as $column) {
                if (Schema::hasColumn('process_histories', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};