<?php

namespace App\Services;

use App\Models\ForumReply;
use App\Repositories\Interfaces\ForumReplyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ForumReplyService {

    public function __construct(private ForumReplyRepository $repository){}
    

    public function listAllReplies():LengthAwarePaginator{
        return $this->repository->listAll();
    }

    public function findByIdTopic(int $idTopic):Collection{
        return $this->repository->findByIdTopic($idTopic);
    }

    public function createReply(array $data):ForumReply{
        return $this->repository->create($data);
    }

    public function updateReply(int $id, array $data):ForumReply{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }

}