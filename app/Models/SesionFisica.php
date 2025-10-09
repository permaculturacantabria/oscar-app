<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SesionFisica extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sesiones_fisicas';

    protected $fillable = [
        'user_id',
        'texto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}