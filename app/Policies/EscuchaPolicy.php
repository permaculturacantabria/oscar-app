<?php

namespace App\Policies;

use App\Models\Escucha;
use App\Models\User;

class EscuchaPolicy
{
    public function view(User $user, Escucha $escucha): bool
    {
        return $user->id === $escucha->usuario_propietario_id;
    }

    public function update(User $user, Escucha $escucha): bool
    {
        return $user->id === $escucha->usuario_propietario_id;
    }

    public function delete(User $user, Escucha $escucha): bool
    {
        return $user->id === $escucha->usuario_propietario_id;
    }
}