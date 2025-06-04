<?php
namespace App\Services;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class CourseService {

    
    public function __construct( private CourseRepository $repository){ }

    public function listAll():LengthAwarePaginator{
        return $this->repository->all();
    }

    public function getById(int $id):?Course{
        return $this->repository->getById($id);
    }

    public function create(array $data):Course{
        return $this->repository->create($data);
    }

    public function update(int $id, array $data):?Course{
        $course = $this->repository->getById($id);
        if(!$course) return null;

        return $this->repository->update($id,$data);
    }

    public function delete(int $id){
        return $this->repository->delete($id);
    }

    public function findByIdTeacher(int $id){
        return $this->repository->teacherById($id);
    }

}