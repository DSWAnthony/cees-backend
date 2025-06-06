<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'open_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:open_date',
            'time_limit' => 'required|numeric',
            'allowed_attemps' => 'required|numeric',
            'max_score' => 'required|numeric',
            'automatic_grading' => 'required|boolean',
            'active' => 'required|boolean',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.type' => 'required|string|in:multiple_choice,open,true_false',
            'questions.*.score' => 'required|numeric',
            'questions.*.order_num' => 'required|numeric',
            'questions.*.active' => 'nullable|boolean',
            'questions.*.options' => 'required_if:questions.*.type,multiple_choice,true_false|array|min:1',
            'questions.*.options.*.option' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
        ];
    }
}
