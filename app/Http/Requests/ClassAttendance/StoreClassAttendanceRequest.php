<?php

namespace App\Http\Requests\ClassAttendance;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClassAttendanceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "message"=>"Ocurrio un error en la validación",
            "errors"=>$validator->errors()
        ],422));
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "live_class_id"=>"required|integer|exists:live_classes,id",
            "student_id"=>"required|integer|exists:users,id",
            "present"=>"sometimes|boolean",
            "connection_time"=>"nullable|integer|min:0"
        ];
    }
}
