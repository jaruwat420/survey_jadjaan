<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'flag_status'
    ];

}
