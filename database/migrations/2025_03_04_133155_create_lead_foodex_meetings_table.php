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
        Schema::create('lead_foodex_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->enum('foodex_meeting', ['Yes', 'No']);
            $table->enum('foodex_event', ['Yes', 'No'])->nullable();
            $table->string('booth_details')->nullable();
            $table->string('visit_time')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('foodex_location')->nullable();
            $table->string('your_booth_details')->nullable();
            $table->string('other_location')->nullable();
            $table->date('jadjaan_date')->nullable();
            $table->time('meeting_time1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_foodex_meetings');
    }
};
