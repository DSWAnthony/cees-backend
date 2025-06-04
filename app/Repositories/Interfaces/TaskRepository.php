<?php
namespace App\Repositories\Interfaces;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskRepository{
    public function listAll():LengthAwarePaginator;
    public function findById(int $id):Task;
    public function create(array $data):Task;
    public function update(int $id, array $data):Task;
    public function delete(int $id):bool;
}