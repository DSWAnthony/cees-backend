<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable=["student_id","course_id","registration_date","date_completed","progress","is_active","certificate_generated","certificate_url"];

    //relations 
    public function student(){
        return $this->belongsTo(User::class,"student_id");
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
