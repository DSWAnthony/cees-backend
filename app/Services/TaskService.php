<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService {

    public function __construct(private TaskRepository $repository){}
    

    public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
    }

    public function findById(int $id):Task{
        return $this->repository->findById($id);
    }

    public function create(array $data):Task{
        return $this->repository->create($data);
    }

    public function update(int $id, array $data):Task{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }

}