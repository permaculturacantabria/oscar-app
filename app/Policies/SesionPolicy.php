<?php

namespace App\Policies;

use App\Models\Sesion;
use App\Models\User;

class SesionPolicy
{
    public function view(User $user, Sesion $sesion): bool
    {
        return $user->id === $sesion->usuario_id;
    }

    public function update(User $user, Sesion $sesion): bool
    {
        return $user->id === $sesion->usuario_id;
    }

    public function delete(User $user, Sesion $sesion): bool
    {
        return $user->id === $sesion->usuario_id;
    }
}