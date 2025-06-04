<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EventService{

    public function __construct(private EventRepository $repository){}
    
    public function listAll():LengthAwarePaginator{
        return $this->repository->listAll();
    }

    public function findById(int $id):Event{
        return $this->repository->findById($id);
    }

    public function create(array $array):Event{
        return $this->repository->create($array);
    }

    public function update(int $id , array $data):Event{
        return $this->repository->update($id,$data);
    }

    public function delete (int $id):bool {
        return $this->repository->delete($id);
    }

}