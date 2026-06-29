<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Raw SQL — safe, no Doctrine, no conflicts
        DB::statement("ALTER TABLE vehicle_registrations MODIFY COLUMN payment_status VARCHAR(30) DEFAULT 'unpaid' NOT NULL;");
    }

    public function down()
    {
        DB::statement("ALTER TABLE vehicle_registrations MODIFY COLUMN payment_status VARCHAR(10) DEFAULT 'unpaid' NOT NULL;");
    }
};