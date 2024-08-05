<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subordinate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trainings(): BelongsToMany
    {
        return $this->belongsToMany(Training::class, 'subordinate_trainings')
            ->withPivot('completed')->withTimestamps();
    }
}
