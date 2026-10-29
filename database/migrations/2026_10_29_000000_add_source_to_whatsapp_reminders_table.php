<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Reminders can now belong to either an added vehicle renewal or an added
    // change of ownership, so the record is identified by (source, record_id).
    // Raw SQL keeps this independent of doctrine/dbal for the column rename.
    public function up()
    {
        if (!Schema::hasTable('whatsapp_reminders') || Schema::hasColumn('whatsapp_reminders', 'source')) {
            return;
        }

        DB::statement("ALTER TABLE `whatsapp_reminders` DROP INDEX `whatsapp_reminders_vehicle_renewal_id_document_field_index`");
        DB::statement("ALTER TABLE `whatsapp_reminders` CHANGE `vehicle_renewal_id` `record_id` BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE `whatsapp_reminders` ADD `source` VARCHAR(50) NOT NULL DEFAULT 'vehicle_renewal' AFTER `id`");
        DB::statement("ALTER TABLE `whatsapp_reminders` ADD INDEX `whatsapp_reminders_source_record_index` (`source`, `record_id`, `document_field`)");
    }

    public function down()
    {
        if (!Schema::hasTable('whatsapp_reminders') || !Schema::hasColumn('whatsapp_reminders', 'source')) {
            return;
        }

        DB::statement("ALTER TABLE `whatsapp_reminders` DROP INDEX `whatsapp_reminders_source_record_index`");
        DB::statement("DELETE FROM `whatsapp_reminders` WHERE `source` <> 'vehicle_renewal'");
        DB::statement("ALTER TABLE `whatsapp_reminders` DROP COLUMN `source`");
        DB::statement("ALTER TABLE `whatsapp_reminders` CHANGE `record_id` `vehicle_renewal_id` BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE `whatsapp_reminders` ADD INDEX `whatsapp_reminders_vehicle_renewal_id_document_field_index` (`vehicle_renewal_id`, `document_field`)");
    }
};
