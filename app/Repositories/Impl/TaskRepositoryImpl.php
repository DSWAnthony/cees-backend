<?php
namespace App\Repositories\Impl;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class TaskRepositoryImpl implements TaskRepository{

    public function listAll():LengthAwarePaginator{
        return Task::with(["course","module"])
                    ->where("is_active",true)
                    ->paginate(15);
    }

    public function findById(int $id):Task{
        $task = Task::where("id",$id)
                    ->where("is_active",true)->first();
        if(!$task) throw new InvalidArgumentException("La Tarea con ID $id No Existe");

        return $task->load(["course","module"]); 
    }

    public function create(array $data):Task{
        $data["is_active"]=true;
        return Task::create($data);
    }

    public function update(int $id, array $data):Task{
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete(int $id):bool{
        Task::findOrFail($id);
        $task = Task::where("id",$id)
                    ->where("is_active",true)
                    ->first();

        if(!$task["is_active"]) throw new InvalidArgumentException("La Tarea no Existe o se Encuentra Eliminado");
        
        $task["is_active"]=false;
        return  $task->save();
    }
    
}