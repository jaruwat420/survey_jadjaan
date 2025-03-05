<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lead_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->string('no_meeting_preference')->nullable();
            $table->date('online_meeting_date')->nullable();
            $table->time('online_meeting_time')->nullable();
            $table->string('company_email_confirmation')->nullable();
            $table->text('specific_info_request')->nullable();
            $table->date('meeting_date')->nullable();
            $table->time('meeting_time')->nullable();
            $table->text('email_profile_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_follow_ups');
    }
};
