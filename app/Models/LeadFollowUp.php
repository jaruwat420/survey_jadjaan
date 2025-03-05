<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFollowUp extends Model
{
    use HasFactory;

    protected $table = 'lead_follow_ups';

    protected $fillable = [
        'lead_id',
        'no_meeting_preference',
        'online_meeting_date',
        'online_meeting_time',
        'company_email_confirmation',
        'specific_info_request',
        'meeting_date',
        'meeting_time',
        'email_profile_message'
    ];

        // สร้างความสัมพันธ์กับโมเดล Lead
        public function lead()
        {
            return $this->belongsTo(Lead::class);
        }
}
