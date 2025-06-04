<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    protected $fillable=["course_id","title","description","meeting_link","recording_link","scheduled_datetime","duration_minutes","is_active","recording_available",];
    protected $hidden=["created_at","updated_at","course_id"];

    public function course(){
        return $this->belongsTo(Course::class,"course_id");
    }

}
