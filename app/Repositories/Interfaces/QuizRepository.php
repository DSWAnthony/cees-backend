<?php
namespace App\Repositories\Interfaces;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Collection;


interface QuizRepository
{
    public function create(array $data): Quiz;
    public function getAll() : Collection;
    
    public function update(int $quizId,array $data) : Quiz;
}