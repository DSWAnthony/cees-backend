<?php

namespace App\Repositories\Impl;

use App\Models\Course;
use App\Models\User;
use App\Repositories\Interfaces\CourseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class CourseRepositoryImpl implements CourseRepository{


    public function all():LengthAwarePaginator{
        return Course::with("teacher")
                    ->where("is_active",true)
                    ->paginate(15);
    }

    public function getById(int $id):?Course{
        $course = $this->courseActive($id);
       return  $course->load("teacher");
    }

    public function create(array $data):Course{
        $data["is_active"]=true;
        return Course::create($data);
    }

    public function update(int $id , array $data):Course{  
        $course = $this->courseActive($id);
        $course->update($data);
        return $course;
    }

    public function delete(int $id):bool{
        $course = $this->courseActive($id);
        $course->is_active=false;
        return $course->save();
    }

    public function teacherById(int $id):LengthAwarePaginator{
        $teacher = User::findOrFail($id);
        return Course::whereHas("teacher",function($query) use($teacher){
            $query->where("id",$teacher->id)
                ->where("role",$teacher->role);
        })->with("teacher")->where("is_active",true)->paginate(15);
    }

    private function courseActive($id){
        $course= Course::findOrFail($id);
        if(!$course->is_active) throw new InvalidArgumentException("El Curso con ID $id No Existe ó esta Eliminado");
        return $course;
    }

    /*
    public function all():LengthAwarePaginator{
        return Course::with("teacher")->paginate(15);
    }

    public function getById(int $id):?Course{
       return Course::findOrFail($id);
    }

    public function create(array $data):Course{
        return Course::create($data);
    }

    public function update(int $id , array $data):Course{  
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function delete(int $id):bool{
        $course = Course::findOrFail($id);
        return $course ? $course->delete() : false;
    }

    public function teacherById(int $id):LengthAwarePaginator{
        $teacher = User::findOrFail($id);
        return Course::whereHas("teacher",function($query) use($teacher){
            $query->where("id",$teacher->id)
                ->where("role",$teacher->role);
        })->with("teacher")->paginate(15);
    }
 */

}