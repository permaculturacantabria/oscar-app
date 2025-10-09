<?php

namespace App\Jobs;

use App\Models\Escucha;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class LinkEscuchaToUserByPhone implements ShouldQueue
{
    use Queueable;

    public function __construct(public Escucha $escucha)
    {
    }

    public function handle(): void
    {
        $user = User::where('telefono', $this->escucha->telefono)->first();

        if ($user) {
            $this->escucha->update(['id_usuario_real' => $user->id]);
        }
    }
}