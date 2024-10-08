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
        Schema::create('change_of_ownerships', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_email');
            $table->string('userType');
            $table->string('process_id');
            $table->string('process_type');
            $table->string('vehicle_category');
            $table->date('vehiclelicenseexpiry_date');
            $table->string('fullname');
            $table->text('address');
            $table->string('phonenumber');
            $table->string('emailaddress');
            $table->string('gender');
            $table->string('occupation');
            $table->date('vehiclelicenseexpiry');
            $table->date('insuranceexpiry');
            $table->date('roadworthinessexpiry');
            $table->date('hackneypermitexpiry');
            $table->date('statecarriagepermitexpiry');
            $table->date('hackneydutypermitexpiry');
            $table->date('localgovernmentpermitexpiry');
            $table->date('policeCMRIS');

            $table->string('vehiclelicensepapers');
            $table->string('proofofownership');
            $table->string('agreement');
            $table->string('meansofid');
            $table->string('payment_status');
            $table->decimal('totalamount', 10, 2);

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
        Schema::dropIfExists('change_of_ownerships');
    }
};
