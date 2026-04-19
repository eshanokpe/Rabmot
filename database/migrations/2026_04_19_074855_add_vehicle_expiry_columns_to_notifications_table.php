<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds vehicle-expiry tracking columns to the notifications table
     * so the scheduler can prevent duplicate alerts.
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Link notification to a specific vehicle
            $table->unsignedBigInteger('vehicle_id')
                  ->nullable()
                  ->after('read_at')
                  ->comment('FK to add_vehicle_renewals — which vehicle triggered this notification');

            // Which document field triggered this (e.g. "vehiclelicenseexpiry")
            $table->string('document_field', 60)
                  ->nullable()
                  ->after('vehicle_id')
                  ->comment('The expiry field that triggered this notification');

            // The threshold that was matched (1, 7, or 15)
            $table->unsignedTinyInteger('days_threshold')
                  ->nullable()
                  ->after('document_field')
                  ->comment('Days-remaining threshold that triggered this notification (1, 7, 15)');

            // Composite index for fast duplicate-check queries
            $table->index(
                ['user_id', 'vehicle_id', 'document_field', 'days_threshold'],
                'notif_dedup_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex('notif_dedup_idx');
            $table->dropColumn(['vehicle_id', 'document_field', 'days_threshold']);
        });
    }
};