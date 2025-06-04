<?php

namespace App\Http\Requests\ForumTopic;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateForumTopicRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "message"=>"La validación fallida",
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
            "forum_id"=>"required|integer|exists:forums,id",
            "title"=>"required|string|min:3|max:200",
            "content"=>"required|string",
            "author_id"=>"required|integer|exists:users,id",
            "pinned"=>"nullable|boolean",
            "closed"=>"nullable|boolean",
        ];
    }
}
