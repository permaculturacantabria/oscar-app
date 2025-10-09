<?php

namespace App\Enums;

enum TipoSesion: string
{
    case LIBRE = 'Libre';
    case PROCESO_10_PASOS = 'Proceso_10_pasos';
}