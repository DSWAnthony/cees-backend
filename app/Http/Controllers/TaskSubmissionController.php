<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskSubmission\StoreTaskSubmissionRequest;
use App\Http\Requests\TaskSubmission\UpdateTaskSubmissionRequest;
use App\Models\TasksSubmission;
use App\Services\TaskSubmissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class TaskSubmissionController extends Controller
{   
    public function __construct(private TaskSubmissionService $service){}

    public function index(){
        return response()->json($this->service->listAll());
    }


    public function store(StoreTaskSubmissionRequest $request){
        $validated = $request->validated();
        
        if ($request->hasFile('file_url')) {
            $path = $request->file('file_url')->store('submissions', 'public');
            $validated['file_url'] = $path;
        }
        
        return response()->json($this->service->create($validated),201);
    }


    public function show(int $id){
        try {
            return response()->json($this->service->findById($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"No se Encontro el Registro con ID $id"],404);
        }
    }


    public function update(UpdateTaskSubmissionRequest $request, int $id){
        try {
            $validated = $request->validated();

            if($request->hasFile("file_url")){
                
                $submissions= TasksSubmission::findOrFail($id);
                if($submissions->file_url && Storage::disk("public")->exists($submissions->file_url) ){
                    Storage::disk("public")->delete($submissions->file_url);
                }


                $path = $request->file("file_url")->store("submissions","public");
                $validated["file_url"]=$path;
            }
            return response()->json($this->service->update($id,$validated));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"No se Encontro el Registro con ID $id"],404);
        }
    }


    public function destroy(int $id){
        try {

            $submissions= TasksSubmission::findOrFail($id);
                if($submissions->file_url && Storage::disk("public")->exists($submissions->file_url) ){
                    Storage::disk("public")->delete($submissions->file_url);
            }

            return $this->service->delete($id) ? response()->json(["message"=>"Se Elimino el Envio de la Tarea con ID $id."])
                                               : response()->json(["message"=>"Ocurrio un Error al Enviar la Tarea"]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"No se Encontro el Registro con ID $id"],404);
        }
    }

    public function getTasksSubmittedByStudent(int $idStudent){
        try {
            return response()->json($this->service->getTasksSubmittedByStudent($idStudent));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"No se Encontro el Registro con ID $idStudent"],404);
        }
    }

    public function getGradedByTeacher(int $idTeacher){
        return response()->json($this->service->getGradedByTeacher($idTeacher));
    }

    public function getPendingTasksByStudent(int $studentId){
        return response()->json($this->service->getPendingTasksByStudent($studentId));
    }

}
