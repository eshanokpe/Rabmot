<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Increase length to 50 characters — more than enough for your format
        DB::statement("ALTER TABLE payment_models MODIFY COLUMN orderNo VARCHAR(50) NOT NULL;");
    }

    public function down()
    {
        // Rollback if needed
        DB::statement("ALTER TABLE payment_models MODIFY COLUMN orderNo VARCHAR(20) NOT NULL;");
    }
};