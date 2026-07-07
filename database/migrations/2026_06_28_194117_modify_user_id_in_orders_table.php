<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('orders')) {
            DB::statement('ALTER TABLE orders MODIFY user_id BIGINT UNSIGNED NULL');
        }
    }

    public function down()
    {
        if (Schema::hasTable('orders')) {
            DB::statement('ALTER TABLE orders MODIFY user_id BIGINT UNSIGNED NOT NULL');
        }
    }
};