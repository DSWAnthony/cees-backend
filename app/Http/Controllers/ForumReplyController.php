<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumReply\StoreForumReplyRequest;
use App\Http\Requests\ForumReply\UpdateForumReplyRequest;
use App\Services\ForumReplyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ForumReplyController extends Controller
{

    public function __construct(private ForumReplyService $service){}
    
    public function index(){
        return response()->json($this->service->listAllReplies());    
    }

    public function store(StoreForumReplyRequest $request){
        $validated = $request->validated();
        return response()->json($this->service->createReply($validated),201);
    }

    public function update(UpdateForumReplyRequest $request, int $id){
        try {
            $validated = $request->validated();
            return response()->json($this->service->updateReply($id,$validated));
        }  catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Respuesta del Foro con ID $id No Existe"],404);
        }
    }


    public function destroy(int $id){
        try {
            return $this->service->delete($id) ? response()->json(["message"=>"La Respuesta con ID $id Fue Eliminado del Foro"])
                                               : response()->json(["message"=>"Ocurrio un Error al Eliminar la Respuesta del Foro"],500);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Respuesta del Foro con ID $id No Existe"],404);
        }
    }

    public function findByIdTopic(int $id){
        return response()->json($this->service->findByIdTopic($id));
    }
}
