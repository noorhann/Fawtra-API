<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tyre extends Model
{
    use HasFactory;
    protected $fillable = [
        'width',
        'height',
        'diameter',
        'country_originals' ,
        'speed_index',
        'quantity',
        'branch',
        'location',
        'note',
        'week',
        'year',
        'brand',
        'expire',
    ];
}
