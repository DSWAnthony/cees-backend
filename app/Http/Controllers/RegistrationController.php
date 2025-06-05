<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\StoreRegistrationRequest;
use App\Http\Requests\Registration\UpdateRegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class RegistrationController extends Controller
{

    public function __construct(private RegistrationService $service){}

    public function index(){
        return response()->json($this->service->listAll());
    }

  
    public function store(StoreRegistrationRequest $request){
            $validated = $request->validated();
            return response()->json($this->service->create($validated),201);
    }


    public function show(int $id){
        try {
           return response()->json($this->service->findById($id));
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        }
    }

    public function update(UpdateRegistrationRequest $request, int $id) {
        try {
            $validated = $request->validated();
            $registration = $this->service->update($id,$validated)->load(["student","course"]);
            return response()->json($registration);
        } catch (EntityNotFoundException $e) {
             return response()->json(["message"=>$e->getMessage()],404);
        }
    }

    public function destroy(int $id) {
        try {
            return $this->service->delete($id) ? response()->json(["message"=>"El Registro con ID $id Fue Eliminado"])
                                                : response()->json(["message"=>"Ocurrio un Error, al Eliminar le Registro"]);
        } catch (ModelNotFoundException $e) {
              return response()->json(["message"=>"La Inscripción con ID $id no Existe"],404);
        } catch (InvalidArgumentException $e){
             return response()->json(["message"=>$e->getMessage()],404);
        }
    }
}
