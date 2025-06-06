<?php
namespace App\Repositories\Impl;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepository;
use Illuminate\Database\Eloquent\Collection;

class QuestionRepositoryImpl implements QuestionRepository
{
    public function updateOrCreate(array $attributes, array $values): bool|Question
    {
        return empty($attributes['id'])
            ? Question::create($values)
            : Question::update($attributes['id'], $values);
    }

    public function findQuestionsByQuiz(int $quiz_id) : Collection {
        
        return Question::with('options')
                    ->where('quiz_id', $quiz_id)
                    ->orderBy('order_num')
                    ->get();
                    
    }
    
    public function deleteMissingQuestions(int $quizId, array $keepIds): bool|null
    {
        return Question::where('quiz_id', $quizId)
                    ->whereNotIn('id', $keepIds)
                    ->delete();
    }
}