<?php

namespace App\Policies;

use App\Models\Tema;
use App\Models\User;

class TemaPolicy
{
    public function view(User $user, Tema $tema): bool
    {
        return $user->id === $tema->user_id;
    }

    public function update(User $user, Tema $tema): bool
    {
        return $user->id === $tema->user_id;
    }

    public function delete(User $user, Tema $tema): bool
    {
        return $user->id === $tema->user_id;
    }
}