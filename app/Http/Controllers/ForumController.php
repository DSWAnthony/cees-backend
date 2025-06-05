<?php

namespace App\Http\Controllers;

use App\Http\Requests\Forum\StoreForumRequest;
use App\Http\Requests\Forum\UpdateForumRequest;
use App\Services\ForumService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ForumController extends Controller
{

    public function __construct(private ForumService $service){}


    public function index(){
        return response()->json($this->service->listAll());
    }


    public function store(StoreForumRequest $request){
        $validated= $request->validated();
        return response()->json($this->service->create($validated),201);
    }


    public function show(int $id){
        try {
            return response()->json($this->service->findById($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Foro con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e){
            return response()->json(["response"=>$e->getMessage()],400);
        }
    }


    public function update(UpdateForumRequest $request, int $id){
        try {
            $validated = $request->validated();
            return response()->json($this->service->update($id,$validated));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Foro con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e){
            return response()->json(["response"=>$e->getMessage()],400);
        }
    }


    public function destroy(int $id){
        try {
            return $this->service->delete($id) ? response()->json(["message"=>"El Foro con ID $id Fue Eliminiado"])
                                                : response()->json(["message"=>"Ocurrio un Error al Eliminar el Foro"],500);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Foro con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e){
            return response()->json(["response"=>$e->getMessage()],400);
        }
    }
}
