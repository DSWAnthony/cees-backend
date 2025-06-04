<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class TaskController extends Controller
{

    public function __construct(private TaskService $service){}

    public function index(){
        return  response()->json($this->service->listAll());
    }

    public function store(StoreTaskRequest $request){
        $validated=$request->validated();
        return response($this->service->create($validated),201);
    }

    public function show(int $id){
        try {
            return response()->json($this->service->findById($id));
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        }
    }

    public function update(UpdateTaskRequest $request, int $id) {
       try {
            $validated= $request->validated();
            return response()->json($this->service->update($id,$validated));
       } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "La Tarea con ID $id No Existe."], 404);
       }
    }

    public function destroy(int $id){
     try {
        return $this->service->delete($id) ? response()->json(["message"=>"La Tarea con ID $id Fue Eliminado"])
                                         : response()->json(["message"=>"Ocurrio un problema al eliminar el registro"],500);

     } catch (InvalidArgumentException $e) {
        return response()->json(["message"=>$e->getMessage()],404);
     } catch (ModelNotFoundException $e) {
         return response()->json(["message"=>"La Tarea con ID $id No Existe"],404);
    }
    }
}
