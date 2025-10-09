<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProximoPaso extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proximos_pasos';

    protected $fillable = [
        'user_id',
        'texto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}