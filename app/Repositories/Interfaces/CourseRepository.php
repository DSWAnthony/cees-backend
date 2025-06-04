<?php

namespace App\Repositories\Interfaces;

use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;

interface CourseRepository {

    public function all():LengthAwarePaginator;
    public function getById(int $id):?Course;
    public function create(array $course):Course;
    public function update(int $id , array $course):Course;
    public function delete(int $id):bool;
    public function teacherById(int $id):LengthAwarePaginator;
}
