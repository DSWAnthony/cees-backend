<?php

namespace App\Http\Requests\Event;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEventRequest extends FormRequest
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
            "course_id"=>"required|integer|exists:courses,id",
            "title"=>"required|string|min:3|max:255",
            "description"=>"nullable|string|max:500",
            "type"=>"required|in:assignment,exam,live_class,general_event",
            "start_datetime"=>"required|date",
            "end_datetime"=>"nullable|date|after:start_datetime",
            "class_link"=>"nullable|string|max:500",
            "created_by"=>"required|integer|exists:users,id",
            "is_active"=>"nullable|boolean"
        ];
    }
}
