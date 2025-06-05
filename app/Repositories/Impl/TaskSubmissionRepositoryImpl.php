<?php
namespace App\Repositories\Impl;

use App\Models\Task;
use App\Models\TasksSubmission;
use App\Models\User;
use App\Repositories\Interfaces\TaskSubmissionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskSubmissionRepositoryImpl implements TaskSubmissionRepository{

    public function listAll():LengthAwarePaginator{
        return TasksSubmission::with(["student","teacher"])->paginate(15);
    }

    public function getTasksSubmittedByStudent(int $idStudent):Collection{
        $student = User::with('tasks')->findOrFail($idStudent);
        return $student->tasks;
    }

    public function getGradedByTeacher(int $idTeacher):Collection{
        return TasksSubmission::where('graded_by', $idTeacher)->with(['task', 'student'])->get();
    }

    public function getPendingTasksByStudent(int $studentId):Collection{
        $submittedTaskIds = TasksSubmission::where('student_id', $studentId)
            ->pluck('task_id')
            ->toArray();

        return Task::whereNotIn('id', $submittedTaskIds)
            ->where('is_active', true)
            ->where('due_date', '>=', now())
            ->get();
    }

    public function findById(int  $id):TasksSubmission{
        return TasksSubmission::with(['task', 'student','teacher'])->findOrFail($id);
    }

    public function create(array $data):TasksSubmission{
         return TasksSubmission::create($data);
    }

    public function update(int $id, array $data):TasksSubmission{
        $submission = TasksSubmission::findOrFail($id);
        $submission->update($data);
        return $submission;
    }

    public function delete(int $id):bool{
        $submission = TasksSubmission::findOrFail($id);
        return $submission->delete();
    }
}