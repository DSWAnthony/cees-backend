<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ["title","description","image_url","teacher_id","price","start_date","end_date","duration_hours","is_active","is_published","certificate_enabled"];
    protected $hidden = ["created_at", "updated_at","image_url"];
    protected $appends = ["imagen_url"];

    // relations
    
    public function teacher(){
        return $this->belongsTo(User::class,"teacher_id");
    }

    public function modules(){
        return $this->hasMany(Module::class);
    }

    public function registrations(){
        return $this->hasMany(Registration::class,"course_id");
    }

    public function students(){
        return $this->belongsToMany(User::class,"registrations","course_id","student_id")
                     ->withPivot(["registration_date","date_completed","progress","is_active","certificate_generated","certificate_url"])
                    ->withTimestamps();
    }

    public function tasks(){
        return $this->hasMany(Task::class,"course_id");
    }

    public function liveClasses(){
        return $this->hasMany(LiveClass::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }
    // accesors

    public function getImagenUrlAttribute(){
        return $this->image_url ? asset("storage/".$this->image_url) : null;
    }

}
