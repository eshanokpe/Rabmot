<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('referral_code')->nullable()->unique()->after('passport_photograph');
            $table->unsignedBigInteger('referred_by')->nullable()->after('referral_code');
        });
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn(['referral_code', 'referred_by']);
        });
    }
};
