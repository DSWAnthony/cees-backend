<?php
namespace App\Repositories\Interfaces;

use App\Models\LiveClass;
use Illuminate\Pagination\LengthAwarePaginator;

interface LiveClassRepository{

    public function listAll():LengthAwarePaginator;
    public function listClassFuture():LengthAwarePaginator;
    public function findById(int $id):LiveClass;
    public function create(array $data):LiveClass;
    public function update(int $id,array $data):LiveClass;
    public function delete(int $id):bool;

}