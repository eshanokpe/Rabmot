<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE international_driver_licenses MODIFY user_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE vehicle_paper_renewals MODIFY user_id BIGINT UNSIGNED NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE international_driver_licenses MODIFY user_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE vehicle_paper_renewals MODIFY user_id BIGINT UNSIGNED NOT NULL');
    }
};
