<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivities extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_name', 'action', 'ip_address', 'user_agent', 'url_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
