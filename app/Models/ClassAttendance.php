<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassAttendance extends Model
{
    protected $fillable=["live_class_id","student_id","present","connection_time","registration_date"];
    protected $hidden=["created_at","updated_at"];

    //relations 

    public function student(){
        return $this->belongsTo(User::class,"student_id");
    }

    public function liveClass(){
        return $this->belongsTo(LiveClass::class,"live_class_id");
    }


}
