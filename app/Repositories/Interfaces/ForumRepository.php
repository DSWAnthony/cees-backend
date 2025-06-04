<?php
namespace App\Repositories\Interfaces;

use App\Models\Forum;
use Illuminate\Pagination\LengthAwarePaginator;

interface ForumRepository {

    public function listAll():LengthAwarePaginator;
    public function findById(int $id):Forum;
    public function create(array $data):Forum;
    public function update(int $id , array $data):Forum;
    public function delete(int $id):bool;
}