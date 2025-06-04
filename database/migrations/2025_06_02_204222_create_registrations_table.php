<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade");
            $table->timestamp("registration_date")->useCurrent();
            $table->timestamp("date_completed")->nullable();
            $table->decimal("progress",5,2)->default(0.00);
            $table->boolean("is_active")->default(true);
            $table->boolean("certificate_generated")->default(false);
            $table->text("certificate_url")->nullable();
            $table->timestamps();
            $table->unique(["student_id","course_id"]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
