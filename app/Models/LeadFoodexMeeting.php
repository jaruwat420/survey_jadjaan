<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFoodexMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'foodex_meeting',
        'foodex_event',
        'booth_details',
        'visit_time',
        'additional_info',
        'foodex_location',
        'your_booth_details',
        'other_location',
        'jadjaan_date',
        'meeting_time1'
    ];

    // สร้างความสัมพันธ์กับโมเดล Lead
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
