<?php
namespace App\Services;

use App\Models\LiveClass;
use App\Repositories\Interfaces\LiveClassRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class LiveClassService{

    public function __construct(private LiveClassRepository $repository){}

    public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
    }
    public function listClassFuture():LengthAwarePaginator{
        return $this->repository->listClassFuture();
    }

    public function findById(int $id):LiveClass{
        return $this->repository->findById($id);
    }

    public function create(array $data):LiveClass{
        return $this->repository->create($data);
    }

    public function update(int $id, array $data):LiveClass{
        return $this->repository->update($id,$data);
    }

    public function delete(int $id):bool{
        return $this->repository->delete($id);
    }
}