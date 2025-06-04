<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $fillable=["forum_id","title","content","author_id","pinned","closed"];
    protected $hidden=["created_at","updated_at","forum_id","author_id"];

    //relations
    public function forum(){
        return $this->belongsTo(Forum::class, "forum_id");
    }

    public function author(){
        return $this->belongsTo(User::class, "author_id");
    }

    public function replies(){
        return $this->hasMany(ForumReply::class,"topic_id");
    }
}
