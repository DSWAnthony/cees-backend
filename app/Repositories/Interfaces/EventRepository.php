<?php
namespace App\Repositories\Interfaces;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;

interface EventRepository{

    public function listAll():LengthAwarePaginator;
    public function findById(int $id):Event;
    public function create(array $data):Event;
    public function update(int $id,array $data):Event;
    public function delete(int $id):bool;
}