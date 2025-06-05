<?php

namespace App\Services;

use App\Models\ForumTopic;
use App\Repositories\Interfaces\ForumTopicRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ForumTopicService{

    public function __construct(private ForumTopicRepository $repository){}

    public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
    }

    public function findById(int $id):ForumTopic{
        return $this->repository->findById($id);
    }

    public function create(array $data):ForumTopic{
        return $this->repository->create($data);    
    }

    public function update(int $id, array $data):ForumTopic{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }
}