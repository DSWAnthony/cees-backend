<?php

namespace App\Http\Requests\Registration;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
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

    public function withValidator($validator)
    {
        $validator->sometimes('date_completed', 'required|date', function ($input) {
            return isset($input->progress) && $input->progress == 100;
        });
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        "student_id"=>[
            "required",
            "integer",
            "exists:users,id",
            Rule::unique('registrations')->where(fn($query)=> $query->where("course_id", $this->input("course_id"))
                                                                    ->where("is_active",true))
        ],
        "course_id"=>"required|integer|exists:courses,id",
        "registration_date"=>"nullable|date",
        "date_completed"=>"nullable|date",
        "progress"=>"nullable|numeric|min:0|max:100",
        "is_active"=>"nullable|boolean",
        "certificate_generated" =>"nullable|boolean",
        "certificate_url"=>"nullable|url|max:500"
        ];
    }
}
