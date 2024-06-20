<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    public function update(User $user, Todo $todo): bool
    {
        return $user->id == $todo->user_id;
    }
    public function delete(User $user, Todo $todo): bool
    {
        return $user->id == $todo->user_id;
    }
}
