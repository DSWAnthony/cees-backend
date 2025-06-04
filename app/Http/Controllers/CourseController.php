<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class CourseController extends Controller
{
    public function __construct(private CourseService $service){}

    public function index(){
        return $this->service->listAll();
    }

    public function store(StoreCourseRequest $request){
        try {
            $validated = $request->validated();

            $course_by_name = Course::where("title", $validated["title"])
                                    ->where("teacher_id", $validated["teacher_id"])
                                    ->first();

            if($course_by_name) {
                return response()->json([
                "message" => "El curso con el título '{$validated['title']}' ya existe para este docente."
            ], 422);
            }

            if($request->hasFile("image_url")){
                $path=$request->file("image_url")->store("course","public");
                $validated["image_url"]=$path;
            }

            $course_new = $this->service->create($validated);

            return response()->json($course_new,201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message"=>"Ocurrio un error al validar",
                "error"=>$e->errors()
            ],422);
        } catch (\Exception $e) {
            return response()->json([
            "message" => "Error inesperado",
            "error" => $e->getMessage(),
            "trace" => $e->getTraceAsString()
            ], 500);
        }
    }

  
    public function show(int $id){
        try {
             if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);
             return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Curso con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        }     
    }

    public function update(UpdateCourseRequest $request, int $id){
        try {
            if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);

            $validated = $request->validated();

            if($request->hasFile("image_url")){

                $course = $this->service->getById($id);
                
                if($course->image_url && Storage::disk("public")->exists($course->image_url)){
                    Storage::disk("public")->delete($course->image_url);
                }


                $path=$request->file("image_url")->store("course","public");
                $validated["image_url"]=$path;
            }

            $course_update = $this->service->update($id,$validated);
            return response()->json($course_update);

        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Usuario con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        }   
        
    }

    public function destroy(int $id){
        try {
            if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);

            $course = $this->service->getById($id);
                
            if($course->image_url && Storage::disk("public")->exists($course->image_url)){
                    Storage::disk("public")->delete($course->image_url);
            }

            return $this->service->delete($id) ? response()->json(["message"=>"Curso Eliminado."],200) :  response()->json(["message" => "No se pudo eliminar el curso."], 400); 
        
        } catch (ModelNotFoundException $e) {
              return response()->json(["message"=>"El Curso con ID $id No Existe"],404);
        } catch (InvalidArgumentException $e) {
            return response()->json(["message"=>$e->getMessage()],404);
        }   
    }

    public function findByIdTeacher($id){
        try {
            if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);
            return $this->service->findByIdTeacher($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Profesor con ID $id No Existe"],404);
        }
    }
}


/*
public function index(){
        return $this->service->listAll();
    }

    public function store(StoreCourseRequest $request){
        try {
            $validated = $request->validated();

            $course_by_name = Course::where("title", $validated["title"])
                                    ->where("teacher_id", $validated["teacher_id"])
                                    ->first();

            if($course_by_name) {
                return response()->json([
                "message" => "El curso con el título '{$validated['title']}' ya existe para este docente."
            ], 422);
            }

            if($request->hasFile("image_url")){
                $path=$request->file("image_url")->store("course","public");
                $validated["image_url"]=$path;
            }

            $course_new = $this->service->create($validated);

            return response()->json($course_new,201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message"=>"Ocurrio un error al validar",
                "error"=>$e->errors()
            ],422);
        } catch (\Exception $e) {
            return response()->json([
            "message" => "Error inesperado",
            "error" => $e->getMessage(),
            "trace" => $e->getTraceAsString()
            ], 500);
        }
    }

  
    public function show(int $id){
        try {
             if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);
             return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Curso con ID $id No Existe"],404);
        }    
    }

    public function update(UpdateCourseRequest $request, int $id){
        try {
            if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);

            $validated = $request->validated();

            if($request->hasFile("image_url")){

                $course = $this->service->getById($id);
                
                if($course->image_url && Storage::disk("public")->exists($course->image_url)){
                    Storage::disk("public")->delete($course->image_url);
                }


                $path=$request->file("image_url")->store("course","public");
                $validated["image_url"]=$path;
            }

            $course_update = $this->service->update($id,$validated);
            return response()->json($course_update);

        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Usuario con ID $id No Existe"],404);
        }
        
    }

    public function destroy(int $id){
        try {
            if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);

            $course = $this->service->getById($id);
                
            if($course->image_url && Storage::disk("public")->exists($course->image_url)){
                    Storage::disk("public")->delete($course->image_url);
            }

            return $this->service->delete($id) ? response()->json(["message"=>"Curso Eliminado."],200) :  response()->json(["message" => "No se pudo eliminar el curso."], 400); 
        
        } catch (ModelNotFoundException $e) {
              return response()->json(["message"=>"El Curso con ID $id No Existe"],404);
        }
    }

    public function findByIdTeacher($id){
        try {
            if (!is_numeric($id))  return response()->json(["message" => "ID inválido"], 400);
            return $this->service->findByIdTeacher($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"El Profesor con ID $id No Existe"],404);
        }
    }


*/