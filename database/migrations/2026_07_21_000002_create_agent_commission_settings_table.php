<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('agent_commission_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('rate', 5, 2)->default(5.00);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('agent_commission_settings')->insert([
            'rate' => 5.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('agent_commission_settings');
    }
};
