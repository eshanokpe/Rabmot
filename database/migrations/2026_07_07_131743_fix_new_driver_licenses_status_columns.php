<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE `new_driver_licenses` MODIFY `payment_status` VARCHAR(20) NOT NULL DEFAULT 'pending'");
        DB::statement("ALTER TABLE `new_driver_licenses` MODIFY `status` VARCHAR(30) NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Intentionally left blank — reverting to decimal would corrupt
        // existing string values like 'paid' or 'processing'.
    }
};