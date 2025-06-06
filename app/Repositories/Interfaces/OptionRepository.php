<?php
namespace App\Repositories\Interfaces;

use App\Models\Option;

interface OptionRepository
{
    public function create(array $data) : Option;
    public function updateOrCreate() : bool|Option;
}