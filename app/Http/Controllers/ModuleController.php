<?php

namespace App\Http\Controllers;

use App\Http\Requests\Module\StoreModuleRequest;
use App\Http\Requests\Module\UpdateModuleRequest;
use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ModuleController extends Controller
{   

    public function __construct(private ModuleService $service){}

    public function index(){
        return $this->service->listAll();
    }

    
    public function store(StoreModuleRequest $request){
        try {

            $validated = $request->validated();
            return response()->json($this->service->create($validated),201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([ "message"=>"Ocurrio un Error al registrar el modulo","error"=>$e->errors() ],422);
        }
    }

  
    public function show(int $id){
        try {
            return $this->service->findById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El modulo con ID $id No Existe"],404);
        }
    
    }

    public function update(UpdateModuleRequest $request, int $id){
        try {
            $validated = $request->validated();
            return response()->json($this->service->update($id,$validated));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El modulo con ID $id No Existe"],404);
        }   
     
    }

    public function destroy(int $id){
        try {
            return $this->service->deleteBy($id) ? response()->json(["message"=>"Modulo Eliminado"])
                                                :  response()->json(["message"=>"Ocurrio un Error al eliminar el modulo"],500);
        } catch (ModelNotFoundException $e) {
            return response()->json([  "message"=>"El modulo con ID $id No Existe"],404);
        }
      
    }
}
