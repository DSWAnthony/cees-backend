<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void{
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade");
            $table->string("title");
            $table->text("description")->nullable();
            $table->string("meeting_link");
            $table->string("recording_link")->nullable();
            $table->dateTime("scheduled_datetime");
            $table->integer("duration_minutes")->default(60);
            $table->boolean("is_active")->default(true);
            $table->boolean("recording_available")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('live_classes');
    }
};
