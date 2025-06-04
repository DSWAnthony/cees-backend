<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade");
            $table->string("title");
            $table->text("description")->nullable();
            $table->enum("type",["assignment","exam","live_class","general_event"]);
            $table->dateTime("start_datetime");
            $table->dateTime("end_datetime")->nullable();
            $table->string("class_link",500)->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
