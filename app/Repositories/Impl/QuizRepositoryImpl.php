<?php
namespace App\Repositories\Impl;

use App\Models\Quiz;
use App\Repositories\Interfaces\QuizRepository;
use Illuminate\Database\Eloquent\Collection;



class QuizRepositoryImpl implements QuizRepository
{
    
    public function create(array $data): Quiz
    {
        return Quiz::create($data);
    }

    public function getAll(): Collection 
    {
        return Quiz::all();
    }

    public function update(int $quizId,array $data) : Quiz
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->update($data);
        return $quiz;
    }
}