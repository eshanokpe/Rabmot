<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Raw SQL instead of Schema::table()->change() — the doctrine/dbal version
        // installed in this project is incompatible with this Laravel version's
        // PDO compatibility shim (pre-existing environment issue).
        DB::statement("ALTER TABLE admins MODIFY role VARCHAR(255) NOT NULL DEFAULT 'staff'");
        DB::statement("ALTER TABLE admins MODIFY status VARCHAR(255) NOT NULL DEFAULT 'active'");

        // Remap legacy values from the parallel role/status system that briefly
        // existed on a separate branch (tinyInteger status, 2-value role enum)
        // before both were reconciled onto this string-based scheme.
        DB::table('admins')->where('status', '1')->update(['status' => 'active']);
        DB::table('admins')->where('status', '0')->update(['status' => 'inactive']);
        DB::table('admins')->where('role', 'admin')->update(['role' => 'support_admin']);
    }

    public function down()
    {
        // Data remap is not reversible; no-op.
    }
};
