<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('wallets')->where('userType', 'agent')->where('status', '0')->update(['status' => 'pending']);
        DB::table('wallets')->where('userType', 'agent')->where('status', '1')->update(['status' => 'approved']);
        DB::table('wallets')->where('userType', 'agent')->where('status', '2')->update(['status' => 'paid']);
    }

    public function down()
    {
        DB::table('wallets')->where('userType', 'agent')->where('status', 'pending')->update(['status' => '0']);
        DB::table('wallets')->where('userType', 'agent')->where('status', 'approved')->update(['status' => '1']);
        DB::table('wallets')->where('userType', 'agent')->where('status', 'paid')->update(['status' => '2']);
    }
};
