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
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("topic_id")->constrained("forum_topics")->onDelete("cascade");
            $table->text("content");
            $table->foreignId("author_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("parent_reply_id")->nullable()->constrained("forum_replies")->onDelete("cascade");
            $table->boolean("approved")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_replies');
    }
};
