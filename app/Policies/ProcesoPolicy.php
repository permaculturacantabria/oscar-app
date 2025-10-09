<?php

namespace App\Policies;

use App\Models\Proceso;
use App\Models\User;

class ProcesoPolicy
{
    public function view(User $user, Proceso $proceso): bool
    {
        return $user->id === $proceso->usuario_id;
    }

    public function update(User $user, Proceso $proceso): bool
    {
        return $user->id === $proceso->usuario_id;
    }

    public function delete(User $user, Proceso $proceso): bool
    {
        return $user->id === $proceso->usuario_id;
    }
}