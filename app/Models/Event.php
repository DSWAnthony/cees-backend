<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $hidden=["created_at","updated_at","course_id"];
    protected $fillable = ["course_id","title","description","type","start_datetime","end_datetime","class_link","created_by","is_active"];

    //relations
    public function course(){
        return $this->belongsTo(Course::class,"course_id");
    }

    public function createdBy(){
        return $this->belongsTo(User::class,"created_by");
    }


}
