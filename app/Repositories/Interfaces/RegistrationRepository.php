<?php
namespace App\Repositories\Interfaces;

use App\Models\Registration;
use Illuminate\Pagination\LengthAwarePaginator;

interface RegistrationRepository{
    
    public function listAll():LengthAwarePaginator;
    public function findById(int $id):Registration;
    public function create(array $data):Registration;
    public function update(int $id, array $data):Registration;
    public function delete(int $id):bool;
}