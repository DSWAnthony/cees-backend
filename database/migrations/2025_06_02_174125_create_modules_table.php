<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade");
            $table->string("title");
            $table->text("description")->nullable();
            $table->integer("order_num");
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->unique(["course_id","order_num"],"unique_course_order");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
