<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TasksSubmission extends Model
{
    protected $fillable=["task_id","student_id","file_url","comment","submission_date","grade","feedback","graded_date","graded_by","attempt_number"];
    protected $hidden=["created_at","updated_at","student_id","file_url"];
    protected $appends = ['file_url_full'];

    public function getFileUrlFullAttribute(){
        return $this->file_url ? asset('storage/'.$this->file_url): null;
    }

    //relations
    public function student(){
        return $this->belongsTo(User::class,"student_id");
    }

    public function task(){
        return $this->belongsTo(Task::class,"task_id");
    }

    public function teacher(){
        return $this->belongsTo(User::class,"graded_by");
    }

}
