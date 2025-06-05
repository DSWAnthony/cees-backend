<?php

namespace App\Repositories\Impl;

use App\Models\ClassAttendance;
use App\Models\LiveClass;
use App\Models\User;
use App\Repositories\Interfaces\ClassAttendaceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassAttendaceRepositoryImpl implements ClassAttendaceRepository{

    public function getAttendanceByClass(int $idClass):LengthAwarePaginator{
        $live_class= LiveClass::findOrFail($idClass);
        return $live_class->classAttendances()->paginate(15);
    }

    public function getStudentsByClass(int $studentId){
        $student = User::findOrFail($studentId);
        return $student->liveClasses;
    }

    public function getById(int $id):ClassAttendance{
        $class_atendance = ClassAttendance::findOrFail($id);
        return $class_atendance->load(["student","liveClass"]);
    }

    public function create(array $data):ClassAttendance{
        return ClassAttendance::create($data)->load(["student","liveClass"]);
    }
    
    public function update(int $id , array $data):ClassAttendance{
        $class_atendance = ClassAttendance::findOrFail($id);
        $class_atendance->update($data);
        return $class_atendance->load(["student","liveClass"]);
    }
    
    public function delete(int $id):bool{
        $class_atendance = ClassAttendance::findOrFail($id);
        return $class_atendance->delete();
    }
}