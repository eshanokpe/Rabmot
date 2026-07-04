<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE dealer_plate_numbers MODIFY payment_status VARCHAR(255) NULL DEFAULT 'unpaid'");
    }

    public function down()
    {
        DB::statement('ALTER TABLE dealer_plate_numbers MODIFY payment_status DECIMAL(8,2) NULL');
    }
};
