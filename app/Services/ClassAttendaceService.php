<?php
namespace App\Services;

use App\Models\ClassAttendance;
use App\Repositories\Interfaces\ClassAttendaceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassAttendaceService {

    public function __construct(private ClassAttendaceRepository $repository){}

    public function getAttendanceByClass(int $idClass):LengthAwarePaginator{
        return $this->repository->getAttendanceByClass($idClass);
    }

    public function getStudentsByClass(int $id){
        return $this->repository->getStudentsByClass($id);
    }

    public function findById(int $id):ClassAttendance{
        return $this->repository->getById($id);
    }

    public function create(array $data):ClassAttendance{
        return $this->repository->create($data);
    }

    public function update(int $id , array $data):ClassAttendance{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }


}