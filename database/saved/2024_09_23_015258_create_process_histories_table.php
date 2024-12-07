<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('process_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('user_email')->nullable();
            $table->string('userType')->nullable();
            $table->string('process_number')->nullable();
            $table->string('process_id')->nullable();
            $table->string('process_type')->nullable();
            $table->integer('process_DLR_lengthofyears')->nullable();
            $table->integer('process_NDL_lengthofyear')->nullable();
            $table->string('process_CO_vc')->nullable();
            $table->string('process_CO_vl')->nullable();
            $table->string('process_VR_name')->nullable();
            $table->string('process_VR_vehicleregistrationType')->nullable();
            $table->string('process_VR_numberplate')->nullable();
            $table->string('process_VR_preferrednumber')->nullable();
            $table->string('process_VPR_vehicleType')->nullable();
            $table->string('process_VPR_vehicleLicense')->nullable();
            $table->boolean('process_VPR_roadWorthiness')->default(false);
            $table->boolean('process_VPR_thirdPartyInsurance')->default(false);
            $table->boolean('process_VPR_vehicleInspectionPickanddrop')->default(false);
            $table->boolean('process_VPR_hackneyPermit')->default(false);
            $table->string('process_DPN_processtype')->nullable();
            $table->string('process_DPN_fullname')->nullable();
            $table->double('totalamount', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_histories');
    }
};
