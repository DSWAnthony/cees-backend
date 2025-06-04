<?php
namespace App\Repositories\Interfaces;

use App\Models\ForumReply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ForumReplyRepository{

    public function listAll():LengthAwarePaginator;
    public function findByIdTopic(int $idTopic):Collection;
    public function create(array $data):ForumReply;
    public function update(int $id , array $data):ForumReply;
    public function delete(int $id):bool;

}