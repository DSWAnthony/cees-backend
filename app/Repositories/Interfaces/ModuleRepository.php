<?php
namespace App\Repositories\Interfaces;

use App\Models\Module;
use Illuminate\Pagination\LengthAwarePaginator;

interface ModuleRepository{

    public function all():LengthAwarePaginator;
    public function findById(int $id):?Module;
    public function create(array $array):Module;
    public function update(int $id, array $array):Module;
    public function delete(int $id):bool;

}