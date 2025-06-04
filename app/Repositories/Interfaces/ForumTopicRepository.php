<?php
namespace App\Repositories\Interfaces;

use App\Models\ForumTopic;
use Illuminate\Pagination\LengthAwarePaginator;

interface ForumTopicRepository{
    
    public function listAll():LengthAwarePaginator;
    public function findById(int $id):ForumTopic;
    public function create(array $data):ForumTopic;
    public function update(int $id , array $data):ForumTopic;
    public function delete(int $id):bool;

}