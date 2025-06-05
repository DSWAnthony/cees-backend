<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ["course_id","title","description","order_num","start_date","end_date","is_active"];
    protected $hidden=["updated_at"];

    //relations 

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class,"module_id");
    }

}
