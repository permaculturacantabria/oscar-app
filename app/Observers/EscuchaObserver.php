<?php

namespace App\Observers;

use App\Models\Escucha;
use App\Services\PhoneNormalizer;

class EscuchaObserver
{
    public function creating(Escucha $escucha): void
    {
        if ($escucha->telefono) {
            $escucha->telefono = PhoneNormalizer::normalize($escucha->telefono);
        }
    }

    public function updating(Escucha $escucha): void
    {
        if ($escucha->isDirty('telefono')) {
            $escucha->telefono = PhoneNormalizer::normalize($escucha->telefono);
        }
    }

    public function created(Escucha $escucha): void
    {
        \App\Jobs\LinkEscuchaToUserByPhone::dispatch($escucha);
    }

    public function updated(Escucha $escucha): void
    {
        if ($escucha->isDirty('telefono')) {
            \App\Jobs\LinkEscuchaToUserByPhone::dispatch($escucha);
        }
    }
}