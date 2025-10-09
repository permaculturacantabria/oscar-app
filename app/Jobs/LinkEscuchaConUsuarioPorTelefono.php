<?php

namespace App\Jobs;

use App\Models\Escucha;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class LinkEscuchaConUsuarioPorTelefono implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $user)
    {
    }

    public function handle(): void
    {
        Escucha::where('telefono', $this->user->telefono)
            ->whereNull('id_usuario_real')
            ->update(['id_usuario_real' => $this->user->id]);
    }
}