<?php

namespace App\Observers;

use App\Jobs\LinkEscuchaConUsuarioPorTelefono;
use App\Models\User;
use App\Services\PhoneNormalizer;

class UserObserver
{
    public function creating(User $user): void
    {
        if ($user->telefono) {
            $user->telefono = PhoneNormalizer::normalize($user->telefono);
        }
    }

    public function updating(User $user): void
    {
        if ($user->isDirty('telefono')) {
            $user->telefono = PhoneNormalizer::normalize($user->telefono);
        }
    }

    public function created(User $user): void
    {
        LinkEscuchaConUsuarioPorTelefono::dispatch($user);
    }

    public function updated(User $user): void
    {
        if ($user->isDirty('telefono')) {
            LinkEscuchaConUsuarioPorTelefono::dispatch($user);
        }
    }
}