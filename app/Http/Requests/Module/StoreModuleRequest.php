<?php

namespace App\Http\Requests\Module;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreModuleRequest extends FormRequest
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
            "course_id"=>"integer|exists:courses,id",
            "title"=>[
                "required",
                "string",
                "min:3",
                Rule::unique('modules')->where(function ($query){
                    return $query->where('course_id',$this->input("course_id"));
                })
            ],
            "description"=>"nullable|string|max:255",
            "order_num"=>[
                "required",
                "integer",
                "min:0",
                Rule::unique('modules')->where(function ($query){
                    return $query->where('course_id',$this->input("course_id"));
                })
            ],
            "start_date"=>"nullable|date",
            "end_date"=>"nullable|date|after_or_equal:start_date",
            "is_active"=>"nullable|boolean"
        ];
    }
}
