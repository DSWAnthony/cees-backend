<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ["course_id","title","description","created_by","is_active","moderated"];
    protected $hidden = ["created_at","updated_at","course_id","is_active"];

    // relations
    public function course(){
        return $this->belongsTo(Course::class, "course_id");
    }

    public function createdBy(){
        return $this->belongsTo(User::class,"created_by");
    }

    public function forumAtopics(){
        return $this->hasMany(ForumTopic::class, "forum_id ");
    }
}
