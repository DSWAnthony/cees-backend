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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable(false)->constrained('modules')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->timestamp('open_date');
            $table->timestamp('due_date');
            $table->integer('time_limit');
            $table->integer('allowed_attemps');
            $table->decimal('max_score',5,2);
            $table->boolean('automatic_grading');
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->cascadeOnDelete();
            $table->string('question');
            $table->enum('type', ['multiple_choice','open','true_false'])->default('multiple_choice');
            $table->decimal('score',5,2);
            $table->integer('order_num');
            $table->boolean('active');
        });

        Schema::create('options', function (Blueprint $table) {
           $table->id();
           
           $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
           $table->string('option')->nullable(false);
           $table->boolean('is_correct')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('questions');        
        Schema::dropIfExists('options');        
    }
};
