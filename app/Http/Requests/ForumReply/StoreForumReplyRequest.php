<?php

namespace App\Http\Requests\ForumReply;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreForumReplyRequest extends FormRequest
{

    public function authorize(): bool{
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
            "topic_id"=>"required|integer|exists:forum_topics,id",
            "content"=>"required|string",
            "author_id"=>"required|integer|exists:users,id",
            "parent_reply_id"=>"nullable|integer|exists:forum_replies,id",
            "approved"=>"sometimes|boolean",
        ];
    }
}
