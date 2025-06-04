<?php

namespace App\Http\Requests\Course;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCourseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "message"=>"Ocurrio un Error en la Validación",
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
                "title"=>"required|string|min:2",
                "description"=>"nullable|string|max:255",
                "image_url"=>"nullable|image|mimes:png,jpg,jpeg|max:5120",
                "teacher_id"=>"nullable|integer|exists:users,id",
                "price"=>"nullable|numeric",
                "start_date"=>"nullable|date",
                "end_date"=>"nullable|date",
                "duration_hours"=>"nullable|integer|min:0",
                "is_active"=>"nullabled|boolean",
                "is_published"=>"nullabled|boolean",
                "certificate_enabled"=>"nullabled|boolean"
        ];
    }
}
