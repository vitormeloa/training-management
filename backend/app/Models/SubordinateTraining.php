<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubordinateTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'subordinate_id',
        'training_id',
        'completed',
    ];
}
