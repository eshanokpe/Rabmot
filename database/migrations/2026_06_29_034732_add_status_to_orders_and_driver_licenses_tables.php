<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add status to orders table
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'status')) {
                    $table->string('status')->default('pending')->after('total');
                }
            });
        }

        // Add status to new_driver_licenses table
        if (Schema::hasTable('new_driver_licenses')) {
            Schema::table('new_driver_licenses', function (Blueprint $table) {
                if (!Schema::hasColumn('new_driver_licenses', 'status')) {
                    $table->string('status')->default('pending')->after('totalamount');
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (Schema::hasColumn('orders', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }

        if (Schema::hasTable('new_driver_licenses')) {
            Schema::table('new_driver_licenses', function (Blueprint $table) {
                if (Schema::hasColumn('new_driver_licenses', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};