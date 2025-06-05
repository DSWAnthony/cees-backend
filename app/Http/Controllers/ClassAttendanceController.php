<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassAttendance\StoreClassAttendanceRequest;
use App\Http\Requests\ClassAttendance\UpdateClassAttendanceRequest;
use App\Services\ClassAttendaceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassAttendanceController extends Controller
{
    public function __construct(private ClassAttendaceService $service){}

    public function attendanceByClass(int $idClass){
        try {
            return response()->json($this->service->getAttendanceByClass($idClass)); 
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Asistencia de Clases con ID $idClass No Existe"],404);
        }
    
    }

    public function attendanceClassesByStudents(int $id){
        try {
            return response()->json($this->service->getStudentsByClass($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Asistencia de Clases con ID $id No Existe"],404);
        } catch (\Throwable $e) {
        // Temporalmente para debug
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTrace()[0]
        ], 500);
    }
    }

    public function store(StoreClassAttendanceRequest $request){
        $validated = $request->validated();
        return response()->json($this->service->create($validated),201);
    }

    public function show(int $id){
        try {
            return response()->json($this->service->findById($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Asistencia de Clases con ID $id No Existe"],404);
        }
    }

    public function update(UpdateClassAttendanceRequest $request, int $id){
        try {
           $validated = $request->validated();
           return response()->json($this->service->update($id,$validated));
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Asistencia de Clases con ID $id No Existe"],404);
        }
    }

    public function destroy(int $id){
        try {
            return $this->service->delete($id) ? response()->json(["message"=>"La Asistencia con ID $id Fue Eliminada"])
                                               : response()->json(["Ocurrio un Error al Eliminar la Asistencia de Clases"],500);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message"=>"La Asistencia de Clases con ID $id No Existe"],404);
        }
    }

}
