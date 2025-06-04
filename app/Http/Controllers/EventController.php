<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Services\EventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class EventController extends Controller
{   
    public function __construct(private EventService $service){}

    public function index(){
        return $this->service->listAll();
    }

    public function store(StoreEventRequest $request){
        $validated = $request->validated();
        return response()->json($this->service->create($validated),201);
    }

   
    public function show(int $id){

      try {
            return response()->json($this->service->findById($id));
      } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Evento con ID $id No Existe"],404);
      } catch (InvalidArgumentException $e){
                        return response()->json(["message"=>$e->getMessage()],404);
      }

    }

    public function update(UpdateEventRequest $request, int $id){

        try {
            $validated = $request->validated();
            return response()->json($this->service->update($id,$validated));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Evento con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e){
                        return response()->json(["message"=>$e->getMessage()],204);
        }  

    }

 
    public function destroy(int $id){
        
        try {
            return  $this->service->delete($id) ?  response()->json(["message"=>"Evento con ID $id Eliminado"],200)
                                                :  response()->json(["message"=>"Ocurrio un Error al Eliminar el Evento"],500);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Evento con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e){
                        return response()->json(["message"=>$e->getMessage()],404);
        }

    }
}
