<?php
namespace App\Repositories\Impl;

use App\Models\Option;
use App\Repositories\Interfaces\OptionRepository;


class OptionRepositoryImpl implements OptionRepository 
{
    public function create(array $data): Option
    {
        return Option::create($data);
    }
}