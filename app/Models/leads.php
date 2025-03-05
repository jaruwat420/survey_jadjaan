<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leads extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'contact_number',
        'country_id',
        'company_option',
        'company',
        'business_type',
        'other_business_type'
    ];

    // ความสัมพันธ์กับ country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // ความสัมพันธ์กับ follow-up
    public function followUp()
    {
        return $this->hasOne(LeadFollowUp::class);
    }

    // ความสัมพันธ์กับ foodex meeting
    public function foodexMeeting()
    {
        return $this->hasOne(LeadFoodexMeeting::class);
    }
}
