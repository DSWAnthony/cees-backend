<?php

namespace App\Repositories\Interfaces;

use App\Models\ClassAttendance;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClassAttendaceRepository{
  
    public function getAttendanceByClass(int $idClass):LengthAwarePaginator;
    public function getStudentsByClass(int $idStudent);
    public function getById(int $id):ClassAttendance;
    public function create(array $data):ClassAttendance;
    public function update(int $id , array $data):ClassAttendance;
    public function delete(int $id):bool;
}