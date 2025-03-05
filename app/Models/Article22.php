<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article22 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_eng',
        'name_japan',
        'flag_status',
    ];
}
