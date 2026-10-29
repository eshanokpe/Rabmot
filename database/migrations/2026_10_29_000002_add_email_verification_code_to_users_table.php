<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('users', 'email_verification_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email_verification_code')->nullable();
            });
        }

        if (! Schema::hasColumn('users', 'email_verification_code_expires_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('email_verification_code_expires_at')->nullable();
            });
        }
    }

    public function down()
    {
        $columns = [];
        foreach (['email_verification_code', 'email_verification_code_expires_at'] as $column) {
            if (Schema::hasColumn('users', $column)) {
                $columns[] = $column;
            }
        }

        if ($columns) {
            Schema::table('users', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
