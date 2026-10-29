<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $columns = [
        'placeofbirthstate',
        'addresslocalgovernment',
        'nationality',
        'occupation',
    ];

    public function up()
    {
        foreach ($this->columns as $column) {
            if (! Schema::hasColumn('new_driver_licenses', $column)) {
                Schema::table('new_driver_licenses', function (Blueprint $table) use ($column) {
                    $table->string($column)->nullable();
                });
            }
        }
    }

    public function down()
    {
        $columns = array_filter(
            $this->columns,
            fn (string $column): bool => Schema::hasColumn('new_driver_licenses', $column)
        );

        if ($columns) {
            Schema::table('new_driver_licenses', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
