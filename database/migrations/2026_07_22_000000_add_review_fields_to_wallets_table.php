<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
            $table->string('transaction_reference')->nullable()->after('rejection_reason');
            $table->string('payment_proof')->nullable()->after('transaction_reference');
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('payment_proof');
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
            $table->unsignedBigInteger('paid_by')->nullable()->after('reviewed_at');
            $table->timestamp('paid_at')->nullable()->after('paid_by');
        });
    }

    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn([
                'rejection_reason',
                'transaction_reference',
                'payment_proof',
                'reviewed_by',
                'reviewed_at',
                'paid_by',
                'paid_at',
            ]);
        });
    }
};
