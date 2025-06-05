<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description")->nullable();
            $table->string("image_url")->nullable();
            $table->foreignId("teacher_id")->constrained("users")->onDelete("cascade");
            $table->decimal("price")->default(0.00);
            $table->date("start_date");
            $table->date("end_date");
            $table->integer("duration_hours");
            $table->boolean("is_active")->default(true);
            $table->boolean("is_published")->default(true);
            $table->boolean("certificate_enabled")->default(false);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
