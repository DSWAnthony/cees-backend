<?php
namespace App\Services;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepository;
use Illuminate\Database\Eloquent\Collection;


class QuestionService
{
    public function __construct(
        private QuestionRepository $questionRepository
    ) {}

    public function createQuestion(array $data) : Question {
        

        return $this->questionRepository->create($data);
    }

    public function getAllByQuiz(int $id) : Collection {
        return $this->questionRepository->findQuestionsByQuiz($id);
    }
}