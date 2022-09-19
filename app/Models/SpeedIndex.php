<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeedIndex extends Model
{
    use HasFactory;

    protected $fillable = [
        'speed',
    ];
}
