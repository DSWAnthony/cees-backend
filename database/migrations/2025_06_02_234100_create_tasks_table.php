<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade");
            $table->foreignId("module_id")->constrained("modules")->onDelete("cascade");
            $table->string("title");
            $table->text("description")->nullable();
            $table->text("instructions")->nullable();
            $table->timestamp("open_date")->useCurrent();
            $table->timestamp("due_date");
            $table->decimal("max_score",5,2)->default(20.00);
            $table->integer("allowed_attempts")->default(1);
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
