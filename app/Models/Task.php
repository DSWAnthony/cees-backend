<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=["course_id","module_id","title","description","instructions","open_date","due_date","max_score","allowed_attempts","is_active"];
    protected $hidden=["created_at","updated_at"];

    //Relations 

    public function course(){
        return $this->belongsTo(Course::class,"course_id");
    }

    public function module(){
        return $this->belongsTo(Module::class,"module_id");
    }

    public function submissions(){
        return $this->hasMany(TasksSubmission::class,"task_id");
    }

    public function students(){
        return $this->belongsToMany(User::class,"tasks_submissions","task_id","student_id");
    }

}
