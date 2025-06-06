<?php
namespace App\Repositories\Interfaces;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

interface QuestionRepository
{
    public function updateOrCreate(array $attributes, array $values) : bool|Question;
    public function findQuestionsByQuiz(int $quiz_id) : Collection;
    public function deleteMissingQuestions(int $quizId, array $keepIds) : bool|null ;
}