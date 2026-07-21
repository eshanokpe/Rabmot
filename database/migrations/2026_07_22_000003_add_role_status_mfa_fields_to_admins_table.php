<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'role')) {
                $table->string('role')->default('staff')->after('email');
            }
            if (!Schema::hasColumn('admins', 'status')) {
                $table->string('status')->default('active')->after('role');
            }
            if (!Schema::hasColumn('admins', 'mfa_enabled')) {
                $table->boolean('mfa_enabled')->default(false)->after('status');
            }
            if (!Schema::hasColumn('admins', 'mfa_secret')) {
                $table->string('mfa_secret')->nullable()->after('mfa_enabled');
            }
        });

        // Raw SQL instead of Schema::table()->change() — the doctrine/dbal version
        // installed in this project is incompatible with this Laravel version's
        // PDO compatibility shim (pre-existing environment issue, unrelated to this change).
        DB::statement('ALTER TABLE admins MODIFY last_login VARCHAR(255) NULL');
        DB::statement('ALTER TABLE admins MODIFY login_ip VARCHAR(255) NULL');
        DB::statement('ALTER TABLE admins MODIFY otp VARCHAR(255) NULL');

        DB::table('admins')->update(['role' => 'super_admin', 'status' => 'active']);
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'mfa_enabled', 'mfa_secret']);
        });
    }
};
