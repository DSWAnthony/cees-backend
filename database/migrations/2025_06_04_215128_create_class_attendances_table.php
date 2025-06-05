<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('class_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("live_class_id")->constrained("live_classes")->onDelete("cascade");
            $table->foreignId("student_id")->constrained("users")->onDelete("cascade");
            $table->boolean("present")->default(false);
            $table->unsignedInteger("connection_time")->default(0);
            $table->timestamp("registration_date")->useCurrent();
            $table->timestamps();
            $table->unique(['live_class_id', 'student_id'], 'unique_attendance');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('class_attendances');
    }
};
