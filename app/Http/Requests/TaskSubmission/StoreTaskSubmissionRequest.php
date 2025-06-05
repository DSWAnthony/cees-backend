<?php

namespace App\Http\Requests\TaskSubmission;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskSubmissionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "message"=>"Ocurrio un error en la Validación",
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
            "task_id"=>"required|integer|exists:tasks,id",
            "student_id"=>"required|integer|exists:users,id",
            "file_url"=>"nullable|file|max:102400",
            "comment"=>"nullable|string",
            "submission_date"=>"nullable|date",
            "grade"=>"nullable|numeric|min:0|max:20",
            "feedback"=>"nullable|string",
            "graded_date"=>"nullable|date|required_with:graded_by",
            "graded_by"=>"nullable|integer|exists:users,id",
            "attempt_number"=>"nullable|integer|min:1"
        ];
    }
}
