<?php
namespace App\Services;

use App\Models\Forum;
use App\Repositories\Interfaces\ForumRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ForumService {

    public function __construct(private ForumRepository $repository){}
    

    public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
    }

    public function findById(int $id):Forum{
        return $this->repository->findById($id);
    }

    public function create(array $data):Forum{
        return $this->repository->create($data);
    }

    public function update(int $id, array $data):Forum{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }

}