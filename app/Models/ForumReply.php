<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model{

    protected $fillable = ["topic_id","content","author_id","parent_reply_id","approved"];
    protected $hidden = ["created_at","updated_at","author_id"];

    //relations 
    public function topic(){
        return $this->belongsTo(ForumTopic::class,"topic_id");
    }

    public function author(){
        return $this->belongsTo(User::class,"author_id");
    }

    public function parent(){
        return $this->belongsTo(ForumReply::class,"parent_reply_id");
    }

    public function children(){
        return $this->hasMany(ForumReply::class, "parent_reply_id")->with(['children','author']);
    }


}
