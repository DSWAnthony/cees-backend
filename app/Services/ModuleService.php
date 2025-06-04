<?php
namespace App\Services;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class ModuleService {

    public function __construct(private ModuleRepository $repository ){}

    public function listAll():LengthAwarePaginator{
        return $this->repository->all();
    }

    public function findById(int $id):?Module {
        return $this->repository->findById($id);
    }

    public function create(array $array):Module{
        $this->validationDate($array);
        return $this->repository->create($array);
    }

    public function update(int $id, array $array ):Module{
        $this->validationDate($array);
        return $this->repository->update($id,$array);
    }

    public function deleteBy(int $id):bool{
        return $this->repository->delete($id);
    }

    public function validationDate(array $data){
        if(!empty($data["start_date"]) && !empty($data["end_date"])){
            $start = Carbon::parse($data["start_date"]);
            $end=Carbon::parse($data["end_date"]);

            if($end->lt($start)){
                throw new InvalidArgumentException("La fecha de fin no puede ser anterior a la fecha de inicio.");
            }
        }
    }

}