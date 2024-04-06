<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public static function createUser(array $userData): User
    {
        return User::create($userData);
    }
    public function find($id)
    {
        return User::findOrFail($id);
    }
    public function save(User $user)
    {
       return $user->save();
    }
}
