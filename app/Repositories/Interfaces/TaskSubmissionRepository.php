<?php
namespace App\Repositories\Interfaces;

use App\Models\TasksSubmission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskSubmissionRepository{
    public function listAll():LengthAwarePaginator;
    public function getTasksSubmittedByStudent(int $idStudent):Collection;
    public function getGradedByTeacher(int $idTeacher):Collection;
    public function getPendingTasksByStudent(int $studentId):Collection;

    public function findById(int  $id):TasksSubmission;
    public function create(array $data):TasksSubmission;
    public function update(int $id, array $data):TasksSubmission;
    public function delete(int $id):bool;
}