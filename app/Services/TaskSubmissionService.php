<?php

namespace App\Services;

use App\Models\TasksSubmission;
use App\Repositories\Interfaces\TaskSubmissionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskSubmissionService {
    public function __construct(private TaskSubmissionRepository $repository){}

     public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
     }

     public function getTasksSubmittedByStudent(int $idStudent):Collection{
        return $this->repository->getTasksSubmittedByStudent($idStudent);
     }

    public function getGradedByTeacher(int $idTeacher):Collection{
        return $this->repository->getGradedByTeacher($idTeacher);
    }

    public function getPendingTasksByStudent(int $studentId):Collection{
        return $this->repository->getPendingTasksByStudent($studentId);
    }

    public function findById(int $id):TasksSubmission{
        return $this->repository->findById($id);
    }

    public function create(array $data):TasksSubmission{
        return $this->repository->create($data);
    }

    public function update(int $id, array $data):TasksSubmission{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }
}