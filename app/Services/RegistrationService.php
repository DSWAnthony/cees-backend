<?php
namespace App\Services;

use App\Repositories\Interfaces\RegistrationRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class RegistrationService{

    public function __construct(private RegistrationRepository $repository){}

    public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
    }

    public function findById(int $id){
        return $this->repository->findById($id);
    }

    public function create(array $data){
        return $this->repository->create($data);
    }

    public function update(int $id, array $data){
        return $this->repository->update($id,$data);
    }

    public function delete(int $id){        
        return $this->repository->delete($id);

    }
}