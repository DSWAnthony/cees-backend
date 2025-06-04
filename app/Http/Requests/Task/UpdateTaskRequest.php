<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validación fallida',
            'errors' => $validator->errors()
        ], 422));
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
            "module_id"=>"required|integer|exists:modules,id",
            "title"=>"required|string|min:3|max:255",
            "description"=>"nullable|string|max:500",
            "instructions"=>"nullable|string|max:500",
            "open_date"=>"nullable|date",
            "due_date"=>"nullable|date|after_or_equal:open_date",
            "max_score"=>"nullable|numeric|min:0",
            "allowed_attempts"=>"nullable|integer|min:1",
            "is_active"=>"nullable|boolean"
        ];
    }
}
