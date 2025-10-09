<?php

namespace App\Enums;

enum Modalidad: string
{
    case PRESENCIAL = 'presencial';
    case ONLINE = 'online';
    case TELEFONO = 'telefono';
}