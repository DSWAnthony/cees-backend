<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tasks_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("task_id")->constrained("tasks")->onDelete("cascade");
            $table->foreignId("student_id")->constrained("users")->onDelete("cascade");
            $table->string("file_url",500)->nullable();
            $table->text("comment")->nullable();
            $table->timestamp("submission_date")->useCurrent();
            $table->decimal("grade",5,2)->nullable();
            $table->text("feedback")->nullable();
            $table->timestamp("graded_date")->nullable();
            $table->foreignId("graded_by")->nullable()->constrained("users")->onDelete("set null");
            $table->unsignedInteger("attempt_number")->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks_submissions');
    }
};
