<?php
namespace App\Services;

use App\Repositories\Interfaces\UserRespository;


class UserService
{
    public function __construct(
        private UserRespository $repository
    ) {}

    public function create(array $data)
    {
         $this->repository->register($data);
    }

}