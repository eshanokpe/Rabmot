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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('title');
            $table->text('body'); // Rich text content
            $table->string('target_audience'); // all_users, all_agents, all_consumers, specific_user, specific_agent
            $table->json('target_ids')->nullable(); // Store IDs/emails for specific targets
            $table->json('channels'); // in_app, email, whatsapp
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->string('delivery_status')->default('draft'); // draft, scheduled, sending, sent, partial, failed
            $table->json('delivery_report')->nullable(); // Success/failure counts
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broadcasts');
    }
};
