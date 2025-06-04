<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId("forum_id")->constrained("forums")->onDelete("cascade");
            $table->string("title",200);
            $table->text("content");
            $table->foreignId("author_id")->constrained("users")->onDelete("cascade");
            $table->boolean("pinned")->default(false);
            $table->boolean("closed")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_topics');
    }
};
