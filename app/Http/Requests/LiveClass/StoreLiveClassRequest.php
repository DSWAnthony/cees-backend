<?php

namespace App\Http\Requests\LiveClass;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLiveClassRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "message"=>"Ocurrio un Error en la Validacion",
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
            "course_id"=>"required|integer|exists:courses,id",
            "title"=>"required|string|min:3|max:200",
            "description"=>"nullable|string|max:500",
            "meeting_link"=>"nullable|string|max:500",
            "recording_link"=>"nullable|string|max:500",
            "scheduled_datetime"=>"required|date|after:now",
            "duration_minutes"=>"nullable|integer|min:1",
            "is_active"=>"nullable|boolean",
            "recording_available"=>"nullable|boolean"
        ];
    }
}
