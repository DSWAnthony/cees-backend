<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumTopic\StoreForumTopicRequest;
use App\Http\Requests\ForumTopic\UpdateForumTopicRequest;
use App\Services\ForumTopicService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ForumTopicController extends Controller
{
    public function __construct(private ForumTopicService $service){}


    public function index(){
        return response()->json($this->service->listAll());       
    }

    public function store(StoreForumTopicRequest $request){
        $validated= $request->validated();
        return response()->json($this->service->create($validated),201);
    }

    public function show(int $id){
        try {
            return response()->json($this->service->findById($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Tema del Foro con ID $id No Existe"],404);
        }
    }

    public function update(UpdateForumTopicRequest $request, int $id){
        try {
            $validated = $request->validated();
            return response()->json($this->service->update($id,$validated));
        } catch (ModelNotFoundException $th) {
            return response()->json(["message"=>"El Tema del Foro con ID $id No Existe"],404);
        }
    }

    public function destroy(int $id){
        try {
            return $this->service->delete($id) ? response()->json(["message"=>"El Tema del Foro con ID $id Fue Eliminado"])
                                               : response()->json(["message"=>"Ocurrio un Error al Eliminar el Tema del Foro"],500);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Tema del Foro con ID $id No Existe"],404);
        }
    }
}
