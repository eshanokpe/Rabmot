<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        if (Schema::hasTable('broadcast_deliveries')) {
            if (Schema::getConnection()->getDriverName() === 'mysql') {
                DB::statement('ALTER TABLE `broadcast_deliveries` MODIFY `status` VARCHAR(100) NOT NULL');

                $index = DB::select(
                    "SHOW INDEX FROM `broadcast_deliveries` WHERE `Key_name` = 'broadcast_deliveries_broadcast_id_status_index'"
                );

                if (empty($index)) {
                    Schema::table('broadcast_deliveries', function (Blueprint $table) {
                        $table->index(['broadcast_id', 'status']);
                    });
                }
            }

            return;
        }

        Schema::create('broadcast_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('broadcast_id')->constrained()->cascadeOnDelete();
            $table->string('recipient_type'); // user, agent
            $table->unsignedBigInteger('recipient_id');
            $table->string('recipient_email')->nullable();
            $table->string('channel'); // in_app, email, whatsapp
            $table->string('status', 100); // sent, failed, skipped
            $table->text('error_message')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->index(['broadcast_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broadcast_deliveries');
    }
};
