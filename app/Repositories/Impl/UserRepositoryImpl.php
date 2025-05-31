<?php
namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\Interfaces\UserRespository;


class UserRepositoryImpl implements UserRespository
{
    public function __construct( private User $user){}

    public function register(array $data): User
    {
        return $this->user->create($data);
    }

}
