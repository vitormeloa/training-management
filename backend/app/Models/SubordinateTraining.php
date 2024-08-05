<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubordinateTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'subordinate_id',
        'training_id',
        'completed',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function subordinate(): BelongsTo
    {
        return $this->belongsTo(Subordinate::class);
    }
}
