<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Businesstype;
use App\Models\TimeVisit;
use App\Models\leads;
use App\Models\LeadFoodexMeeting;
use App\Models\LeadFollowUp;

class LeadDropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $path = $request->path();
        if ($path == 'contact') {
            return view ('lang.index', compact('path'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    // public function store(Request $request)
    // {
    //     dd($request->all());
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try {
         // บันทึกข้อมูลหลัก Lead
         $lead = new leads();
         $lead->firstname = $request->firstname;
         $lead->lastname = $request->lastname;
         $lead->email = $request->email;
         $lead->contact_number = $request->contact_number;
         $lead->country_id = $request->country;
         $lead->company_option = $request->company_option;
         $lead->company = $request->company;
         $lead->business_type = $request->business_type;
         $lead->other_business_type = $request->other_business_type;
         $lead->save();

         // บันทึกข้อมูล Foodex Meeting
         if ($request->foodex_meeting) {
             $foodexMeeting = new LeadFoodexMeeting();
             $foodexMeeting->lead_id = $lead->id;
             $foodexMeeting->foodex_meeting = $request->foodex_meeting;

             // กำหนดค่าเริ่มต้นเพื่อไม่ให้เป็น NULL
             $foodexMeeting->foodex_event = $request->foodex_event ?? 'No'; // ใช้ค่าเริ่มต้นเป็น 'No' ถ้าไม่มีค่า

             $foodexMeeting->booth_details = $request->booth_details;
             $foodexMeeting->visit_time = $request->visit_time;
             $foodexMeeting->additional_info = $request->additional_info;
             $foodexMeeting->foodex_location = $request->foodex_location;
             $foodexMeeting->your_booth_details = $request->your_booth_details;
             $foodexMeeting->other_location = $request->other_location;
             $foodexMeeting->jadjaan_date = $request->jadjaan_date;
             $foodexMeeting->meeting_time1 = $request->meeting_time1;
             $foodexMeeting->save();
         }

         if ($request->no_meeting_preference || $request->meeting_date || $request->email_profile_message) {
             $followUp = new LeadFollowUp();
             $followUp->lead_id = $lead->id;
             $followUp->no_meeting_preference = $request->no_meeting_preference;
             $followUp->online_meeting_date = $request->online_meeting_date;
             $followUp->online_meeting_time = $request->online_meeting_time;
             $followUp->company_email_confirmation = $request->company_email_confirmation;
             $followUp->specific_info_request = $request->specific_info_request;
             $followUp->meeting_date = $request->meeting_date;
             $followUp->meeting_time = $request->meeting_time;
             $followUp->email_profile_message = $request->email_profile_message;
             $followUp->save();
         }
       } catch (\Throwable $th) {
        //throw $th;
       }

        return redirect()->back()->with('message', 'Your information has been submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // country
        $country = Country::all();

        // businesstype
        $Businesstype = Businesstype::all();

        // Timevisit
        $visitTimes =  TimeVisit::all();


        return view ('frontend.contact.contact', compact('country', 'Businesstype', 'visitTimes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
