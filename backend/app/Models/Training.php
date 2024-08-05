<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function subordinates(): BelongsToMany
    {
        return $this->belongsToMany(Subordinate::class, 'subordinate_trainings')
            ->withPivot('completed')->withTimestamps();
    }
}
