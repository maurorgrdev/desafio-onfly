<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model = User::class;

    public function find_user_by_email($email)
    {
        return User::where('email', $email)->first();
    }
}