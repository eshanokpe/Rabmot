<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Expiry reminders now go out by email and SMS as well as WhatsApp, so the
    // log records the channel, whether it was sent, and why it failed.
    // Raw SQL keeps this independent of doctrine/dbal for the renames.
    public function up()
    {
        if (!Schema::hasTable('whatsapp_reminders') || Schema::hasTable('document_reminders')) {
            return;
        }

        DB::statement("RENAME TABLE `whatsapp_reminders` TO `document_reminders`");
        DB::statement("ALTER TABLE `document_reminders` CHANGE `recipient_phone` `recipient` VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE `document_reminders` ADD `channel` VARCHAR(20) NOT NULL DEFAULT 'whatsapp' AFTER `document_field`");
        DB::statement("ALTER TABLE `document_reminders` ADD `status` VARCHAR(20) NOT NULL DEFAULT 'sent' AFTER `channel`");
        DB::statement("ALTER TABLE `document_reminders` ADD `error_message` VARCHAR(255) NULL AFTER `message`");
        DB::statement("ALTER TABLE `document_reminders` MODIFY `message` TEXT NULL");
    }

    public function down()
    {
        if (!Schema::hasTable('document_reminders') || Schema::hasTable('whatsapp_reminders')) {
            return;
        }

        DB::statement("DELETE FROM `document_reminders` WHERE `channel` <> 'whatsapp'");
        DB::statement("ALTER TABLE `document_reminders` DROP COLUMN `channel`, DROP COLUMN `status`, DROP COLUMN `error_message`");
        DB::statement("ALTER TABLE `document_reminders` CHANGE `recipient` `recipient_phone` VARCHAR(255) NOT NULL");
        DB::statement("RENAME TABLE `document_reminders` TO `whatsapp_reminders`");
    }
};
