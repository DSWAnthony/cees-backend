<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiveClass\StoreLiveClassRequest;
use App\Http\Requests\LiveClass\UpdateLiveClassRequest;
use App\Services\LiveClassService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class LiveClassController extends Controller
{

    public function __construct(private LiveClassService $service){}

    public function index(){
        return $this->service->listAll();
    }

    public function store(StoreLiveClassRequest $request){
        $validated = $request->validated();
        return response()->json($this->service->create($validated),201);
    }

    public function show(int $id){
        try {
            return response()->json($this->service->findById($id));
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        } catch (ModelNotFoundException $e){
              return response()->json(["message"=>"La Clase con ID $id No Existe"],404);
        }
    }

    public function update(UpdateLiveClassRequest $request, int $id){
        try {
            $validated = $request->validated();
            return response()->json($this->service->update($id, $validated));
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        } catch (ModelNotFoundException $e){
            return response()->json(["message"=>"La Clase con ID $id No Existe"],404);
        }
    }

    public function destroy(int $id){
        try {
            return $this->service->delete($id) ? response()->json(["message"=>"La Clase En Vivo Fue Eliminado"])
                                                : response()->json(["message"=>"Ocurrio un Error al Eliminar la Clase"]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Clase En Vivo con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        }
    }

    public function classFuture(){
        //return response()->json(["message"=>"hola soy del futuro"]);
        return response()->json($this->service->listClassFuture());
    }
}
