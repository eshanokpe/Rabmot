<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE change_of_ownerships
            ADD COLUMN status VARCHAR(30) DEFAULT 'pending' NULL,
            MODIFY COLUMN payment_status VARCHAR(30) DEFAULT 'unpaid' NOT NULL,
            MODIFY COLUMN process_id VARCHAR(50) NOT NULL,
            MODIFY COLUMN totalamount DECIMAL(12,2) DEFAULT 0 NOT NULL;
        ");
    }

    public function down()
    {
        DB::statement("ALTER TABLE change_of_ownerships
            DROP COLUMN date_of_birth,
            DROP COLUMN place_of_birth,
            DROP COLUMN lga,
            DROP COLUMN state,
            DROP COLUMN chassis_number,
            DROP COLUMN engine_number,
            DROP COLUMN vehicle_make,
            DROP COLUMN vehicle_color,
            DROP COLUMN road_worthiness_paper,
            DROP COLUMN chassis_image,
            DROP COLUMN nin_slip,
            DROP COLUMN status;
        ");
    }
};