<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'app_sessions';

    protected $fillable = [
        'user_id',
        'listener_id',
        'listener_name',
        'scheduled_at',
        'status',
        'notes',
        'categories',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'categories' => 'array',
    ];
}


