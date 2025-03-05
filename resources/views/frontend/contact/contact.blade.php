@extends('frontend.layouts.master')

@section('title', 'url')
@section('css')

@endsection

@section('content')
<section class="fp__faq pt_100 xs_pt_70 pb_100 xs_pb_70">
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="card">
                <div class="card-body">

                </div>
            </div> --}}
            <div class="col-lg-9 wow fadeInUp">
                <div class="container mt-5">
                    <div class="logo-container">
                        <img src="{{ asset('uploads/jadjaan_logo.png') }}" alt="JadJaan Logo">
                    </div>
                    @if(session('message'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('message') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">
                                    <i class="fas fa-user me-2"></i>First Name
                                </label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">
                                    <i class="fas fa-user me-2"></i>Last Name
                                </label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-user me-2"></i>Email
                                </label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_number" class="form-label">
                                    <i class="fas fa-phone me-2"></i>Contact Number
                                </label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="country" class="form-label">
                                <i class="fas fa-globe me-2"></i> Country <span class="text-danger">*</span>
                            </label>
                            <small class="text-danger">Please enter country</small>
                            <select class="form-select" aria-label="Default select example" id="country" name="country" required>
                                <option selected value="">Select a country</option>
                                @foreach($country as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-building me-2"></i>Company Name
                            </label>

                            <!-- Dropdown Container -->
                            <div id="company_select_container">
                                <select class="form-select" id="company_option" name="company_option" onchange="handleCompanyOption()">
                                    <option value="" >Choose Company *</option>
                                    <option value="None" >No</option>
                                    <option value="has_company" >Yes</option>
                                </select>
                            </div>

                            <!-- Text input Container (hidden initially) -->
                            <div id="company_input_container" style="display: none;">
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company name" value="{{ old('company') }}">
                                    <button type="button" class="btn btn-outline-secondary ms-2" onclick="backToCompanySelect()">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4" id="business_type_container" style="display: none;">
                            <label for="business_type" class="form-label">
                                <i class="fas fa-briefcase me-2"></i>Business Type
                            </label>

                            <div id="business_type_select_container">
                                <select class="form-control custom-select" id="business_type" name="business_type" onchange="toggleBusinessTypeInput()">
                                    <option value="" selected>Choose Business Type *</option>
                                    @foreach($Businesstype as $type)
                                    <option value="{{ $type->name_eng }}" {{ old('business_type') == $type->name_eng ? 'selected' : '' }}>
                                        {{ $type->name_eng }}
                                    </option>
                                    @endforeach
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Other Business Type Input (ซ่อนไว้ตอนเริ่มต้น) -->
                            <div id="other_business_type_container" style="display: none; margin-top: 10px;">
                                <input type="text" class="form-control" id="other_business_type" name="other_business_type" placeholder="Please specify your business type" value="{{ old('other_business_type') }}">
                            </div>
                        </div>

                        <!-- คำถามที่ 8: Would you like to arrange a meeting with us during the Foodex Japan event? -->
                        <div class="mb-4" id="foodex_meeting_container">
                            <label class="form-label mt-4">
                                <i class="fas fa-calendar-alt me-2"></i>Would you like to arrange a meeting with us during the Foodex Japan event?
                            </label>
                            <select class="form-select" id="foodex_meeting" name="foodex_meeting" onchange="toggleFoodexQuestions() " require>
                                <option value="" selected>Choose</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <!-- คำถามที่ 9: Do you have a booth at the Foodex event? -->
                        <div class="mb-4" id="foodex_event_container" style="display: none;">
                            <label class="form-label mt-4">
                                <i class="fas fa-calendar-alt me-2"></i>Do you have a booth at the Foodex event?
                            </label>
                            <select class="form-select" id="foodex_event" name="foodex_event" onchange="toggleFoodexEvent()">
                                <option value="" selected>Choose</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <!-- คำถามที่ 10: Your Booth's Hall and Number -->
                        <div class="mb-4" id="booth_details_container" style="display: none;">
                            <label for="booth_details" class="form-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Your Booth's Hall and Number
                            </label>
                            <input type="text" class="form-control" id="booth_details" name="booth_details" >
                        </div>

                        <!-- คำถามที่ 11: Please provide your preferred date and time -->
                        <div class="mb-4" id="visit_time_container" style="display: none;">
                            <label class="form-label">
                                <i class="fas fa-clock me-2"></i>Please provide your preferred date and time for Chaixi's team to visit your booth.
                            </label>
                            <select class="form-select" id="visit_time" name="visit_time">
                                <option value="" selected>Choose Time Slot</option>
                                @foreach($visitTimes as $time)
                                    <option value="{{ $time->id }}" {{ old('visit_time') == $time->id ? 'selected' : '' }}>
                                        {{ $time->time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- คำถามที่ 12: What additional information would you like to know about our product, JadJaan? -->
                        <div class="mb-4" id="additional_info_container" style="display: none;">
                            <label for="additional_info" class="form-label">
                                <i class="fas fa-info-circle me-2"></i>What additional information would you like to know about our product, JadJaan?
                            </label>
                            <textarea class="form-control" id="additional_info" name="additional_info" rows="4" required></textarea>
                        </div>

                        <!-- คำถามที่ 13: Thank you message for booth visitors -->
                        <div class="mb-4" id="visit_booth_message" style="display: none;">
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                Thank you for your interest in our product, JadJaan. Please visit our booth again on 11-14 March 2025 from 10:00 a.m. to 5:00 p.m.
                            </div>
                        </div>

                        <!-- คำถามที่ 14-15: Thank you message for no meeting -->
                        <div class="mb-4" id="thank_you_message" style="display: none;">
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                Thank you for your interest in our product, JadJaan. Our Chaixi staff members will contact you soon.
                            </div>
                        </div>


                        <div id="foodex_questions" style="display: none;">
                            <!-- Location Question -->
                            <div class="mb-4" id="question_location">
                                <label for="foodex_location" class="form-label">
                                    <i class="fas fa-map-marker-alt me-2"></i>Location
                                </label>
                                <select class="form-select" id="foodex_location" name="foodex_location" onchange="showLocationDetails()">
                                    <option value="" selected>Choose location</option>
                                    <option value="Jadjaan Exhibition Booth" {{ old('foodex_location') == 'Jadjaan Exhibition Booth' ? 'selected' : '' }}>Jadjaan Exhibition Booth</option>
                                    <option value="Your Booth Exhibition Booth" {{ old('foodex_location') == 'Your Booth Exhibition Booth' ? 'selected' : '' }}>Your Booth Exhibition Booth</option>
                                    <option value="Other" {{ old('foodex_location') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>

                                <!-- Location specific additional inputs - Removed the jadjaan_location_details div -->
                                <div id="your_booth_location_details" class="mt-2 d-none">
                                    <input type="text" class="form-control" id="your_booth_details" name="your_booth_details" placeholder="Enter the booth number">
                                </div>

                                <div id="other_location_details" class="mt-2 d-none">
                                    <input type="text" class="form-control" id="other_location" name="other_location" placeholder="please specify">
                                </div>
                            </div>

                            <!-- JadJaan Exhibition Booth Date Selection - Always visible when foodex_questions is shown -->
                            <div class="mb-4" id="question_jadjaan_date">
                                <label for="jadjaan_date" class="form-label">
                                    <i class="fas fa-calendar-alt me-2"></i>Date
                                </label>
                                <select class="form-select" id="jadjaan_date" name="jadjaan_date">
                                    <option value="" selected>Choose a date</option>
                                    <option value="2025-03-11" {{ old('jadjaan_date') == '2025-03-11' ? 'selected' : '' }}>March 11, 2025</option>
                                    <option value="2025-03-12" {{ old('jadjaan_date') == '2025-03-12' ? 'selected' : '' }}>March 12, 2025</option>
                                    <option value="2025-03-13" {{ old('jadjaan_date') == '2025-03-13' ? 'selected' : '' }}>March 13, 2025</option>
                                    <option value="2025-03-14" {{ old('jadjaan_date') == '2025-03-14' ? 'selected' : '' }}>March 14, 2025</option>
                                </select>
                            </div>

                            <!-- Time Question -->
                            <div class="mb-4" id="question_time">
                                <label for="meeting_time1" class="form-label">
                                    <i class="fas fa-clock me-2"></i>Time
                                </label>
                                <input type="time" class="form-control" id="meeting_time1" name="meeting_time1" value="{{ old('meeting_time1') }}">
                            </div>
                        </div>

                        <!-- Add a container for the follow-up question when the answer is No -->
                        <div class="mb-4" id="follow_up_options" style="display: none;">
                            <label class="form-label mt-4">
                                <i class="fas fa-question-circle me-2"></i>Do you prefer to arrange an online meeting at another time after Foodex Japan or receive our company profile and sales kit through email?
                            </label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="follow_up_option" id="online_meeting_option" value="Online Meeting">
                                <label class="form-check-label" for="online_meeting_option">
                                    Arrange an online meeting at another time
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="follow_up_option" id="email_profile_option" value="Email Profile">
                                <label class="form-check-label" for="email_profile_option">
                                    Receive company profile and sales kit through email
                                </label>
                            </div>
                        </div>

                        <!-- Input for online meeting date and time, initially hidden -->
                        <div class="mb-4" id="online_meeting_details" style="display: none;">
                            <label for="meeting_date" class="form-label">
                                <i class="fas fa-calendar-alt me-2"></i>Select a Date for Online Meeting
                            </label>
                            <input type="date" class="form-control" id="meeting_date" name="meeting_date">

                            <label for="meeting_time" class="form-label mt-2">
                                <i class="fas fa-clock me-2"></i>Select a Time for Online Meeting
                            </label>
                            <input type="time" class="form-control" id="meeting_time" name="meeting_time">
                        </div>

                        <!-- Input for receiving company profile and sales kit through email -->
                        <div class="mb-4" id="email_profile_details" style="display: none;">
                            <label for="email_profile_message" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Message (Optional)
                            </label>
                            <textarea class="form-control" id="email_profile_message" name="email_profile_message" rows="4"></textarea>
                        </div>
                        <button class="btn btn-success" type="submit">SUBMIT</button>
                        <button class="btn btn-danger" type="reset">CLEAR</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // เริ่มต้นเมื่อโหลดหน้าเว็บ
    document.addEventListener("DOMContentLoaded", function() {
        // เริ่มต้นสถานะฟอร์ม
        handleCompanyOption();
        toggleFoodexQuestions();
        toggleFoodexEvent();
        toggleBusinessTypeInput();
    });

    // ฟังก์ชันจัดการตัวเลือก Company
    function handleCompanyOption() {
        const companyOption = document.getElementById("company_option");
        const companySelectContainer = document.getElementById("company_select_container");
        const companyInputContainer = document.getElementById("company_input_container");
        const companyInput = document.getElementById("company");
        const businessTypeContainer = document.getElementById("business_type_container");
        const businessType = document.getElementById("business_type");
        const businessTypeSelectContainer = document.getElementById("business_type_select_container");
        const otherBusinessTypeContainer = document.getElementById("other_business_type_container");
        const foodexContainer = document.getElementById("foodex_meeting_container");

        if (companyOption.value === "has_company") {
            // ถ้าเลือก "Yes" สำหรับ Company Name
            companySelectContainer.style.display = "none";
            companyInputContainer.style.display = "block";
            companyInput.focus();
            companyInput.setAttribute("required", "required");
             // แสดงส่วน Business Type
            businessTypeContainer.style.display = "block";
            businessType.setAttribute("required", "required");

            foodexContainer.style.display = "block";
        } else if (companyOption.value === "None") {
            // แสดงส่วน Business Type
            businessTypeContainer.style.display = "block";
            businessType.setAttribute("required", "required");

            // แสดงส่วน Foodex Meeting
            foodexContainer.style.display = "block";

            if (businessTypeSelectContainer && otherBusinessTypeContainer) {
                businessTypeSelectContainer.style.display = "block";
                otherBusinessTypeContainer.style.display = "none";
            }
        } else {
            // ถ้าเลือก "No" สำหรับ Company Name
            companySelectContainer.style.display = "block";
            companyInputContainer.style.display = "none";
            companyInput.value = "";
            companyInput.removeAttribute("required");

            // ซ่อนส่วน Business Type
            businessTypeContainer.style.display = "none";
            businessType.removeAttribute("required");
            businessType.value = "";

            // ซ่อนส่วน Foodex Meeting
            foodexContainer.style.display = "none";
            document.getElementById("foodex_meeting").value = "";

            // รีเซ็ตค่าที่เกี่ยวข้อง
            toggleFoodexQuestions();
        }

        toggleBusinessTypeInput();
    }

    // ฟังก์ชันย้อนกลับไปยังตัวเลือก Company
    function backToCompanySelect() {
        const companyOption = document.getElementById("company_option");
        const companySelectContainer = document.getElementById("company_select_container");
        const companyInputContainer = document.getElementById("company_input_container");
        const companyInput = document.getElementById("company");

        // รีเซ็ตค่ากลับเป็น "No"
        companyOption.value = "None";

        // แสดงตัวเลือกและซ่อนช่องกรอกข้อมูล
        companySelectContainer.style.display = "block";
        companyInputContainer.style.display = "none";
        companyInput.value = "";
        companyInput.removeAttribute("required");

        // เรียกฟังก์ชันหลักเพื่อซ่อนฟิลด์ที่เกี่ยวข้อง
        handleCompanyOption();
    }

    // ฟังก์ชันจัดการตัวเลือก Business Type
    function toggleBusinessTypeInput() {
        const businessType = document.getElementById("business_type");
        const businessTypeSelectContainer = document.getElementById("business_type_select_container");
        const otherBusinessTypeContainer = document.getElementById("other_business_type_container");
        const otherInput = document.getElementById("other_business_type");

        // ตรวจสอบว่าค่าที่เลือกเป็น "Other" หรือไม่ (ไม่ว่าจะมาจากฐานข้อมูลหรือไม่ก็ตาม)
        if (businessType && businessType.value.toLowerCase() === "other") {
            // ถ้าเลือก "Other"
            if (businessTypeSelectContainer && otherBusinessTypeContainer) {
                businessTypeSelectContainer.style.display = "none";
                otherBusinessTypeContainer.style.display = "block";
                // otherInput.focus();
                // otherInput.setAttribute("required", "required");
            }
        } else {
            // ถ้าเลือกตัวเลือกอื่น ๆ
            if (businessTypeSelectContainer && otherBusinessTypeContainer) {
                businessTypeSelectContainer.style.display = "block";
                otherBusinessTypeContainer.style.display = "none";
            }
            if (otherInput) {
                otherInput.removeAttribute("required");
                otherInput.value = "";
            }
        }
    }

    // เรียกใช้ฟังก์ชันเมื่อโหลดหน้า
    document.addEventListener('DOMContentLoaded', function() {
        toggleBusinessTypeInput();
    });

    // เรียกใช้ฟังก์ชันเมื่อโหลดหน้า
    document.addEventListener('DOMContentLoaded', function() {
        toggleBusinessTypeInput();
    });

    // ฟังก์ชันย้อนกลับไปยังตัวเลือก Business Type
    function backToBusinessTypeSelect() {
        const businessTypeSelectContainer = document.getElementById("business_type_select_container");
        const otherBusinessTypeContainer = document.getElementById("other_business_type_container");
        const businessType = document.getElementById("business_type");
        const otherInput = document.getElementById("other_business_type");

        if (businessTypeSelectContainer && otherBusinessTypeContainer) {
            businessTypeSelectContainer.style.display = "block";
            otherBusinessTypeContainer.style.display = "none";
        }

        if (businessType) {
            businessType.value = "";
        }

        if (otherInput) {
            otherInput.removeAttribute("required");
            otherInput.value = "";
        }
    }

    // ฟังก์ชันจัดการคำถาม Foodex Meeting (คำถามที่ 8)
    function toggleFoodexQuestions() {
    const foodexMeeting = document.getElementById("foodex_meeting").value;
    const foodexEventContainer = document.getElementById("foodex_event_container");
    const additionalInfoContainer = document.getElementById("additional_info_container");
    const additionalInfoInput = document.getElementById("additional_info");
    const thankYouMessage = document.getElementById("thank_you_message");

    // ซ่อนทุกส่วนที่เกี่ยวข้องก่อน
    hideAllFoodexRelatedSections();

    if (foodexMeeting === "Yes") {
        // แสดงคำถามที่ 9
        foodexEventContainer.style.display = "block";
    } else if (foodexMeeting === "No") {
        // แสดงคำถามที่ 14 และ 15
        additionalInfoContainer.style.display = "block";
        additionalInfoInput.setAttribute("required", "required");
        thankYouMessage.style.display = "block";
    }
}

    // ฟังก์ชันจัดการคำถาม Foodex Event (คำถามที่ 9)
    function toggleFoodexEvent() {
        const foodexEvent = document.getElementById("foodex_event").value;

        // ซ่อนส่วนที่เกี่ยวข้องกับคำถามนี้ก่อน
        document.getElementById("booth_details_container").style.display = "none";
        document.getElementById("visit_time_container").style.display = "none";
        document.getElementById("visit_booth_message").style.display = "none";
        document.getElementById("additional_info_container").style.display = "none";
        const boothDetailsInput = document.getElementById("booth_details")

        if (foodexEvent === "Yes") {
            // ถ้าเลือก "Yes" สำหรับการมี booth
            // แสดงคำถามที่ 10 (Your Booth's Hall and Number)
            document.getElementById("booth_details_container").style.display = "block";
            // แสดงคำถามที่ 11 (Please provide preferred date and time)
            document.getElementById("visit_time_container").style.display = "block";
            // แสดงคำถามที่ 12 (Additional information)
            document.getElementById("additional_info_container").style.display = "block";
            boothDetailsInput.setAttribute("required", "required");
        } else if (foodexEvent === "No") {
            // ถ้าเลือก "No" สำหรับการมี booth
            // แสดงคำถามที่ 13 (Thank you message)
            document.getElementById("visit_booth_message").style.display = "block";
            // แสดงคำถามที่ 12 (Additional information)
            document.getElementById("additional_info_container").style.display = "block";
            boothDetailsInput.removeAttribute("required");
        }
    }

    // ฟังก์ชันซ่อนทุกส่วนที่เกี่ยวข้องกับ Foodex
    function hideAllFoodexRelatedSections() {
        // ซ่อนส่วนที่เกี่ยวข้องกับ Foodex ทั้งหมด
        if (document.getElementById("foodex_event_container")) {
            document.getElementById("foodex_event_container").style.display = "none";
        }
        if (document.getElementById("foodex_questions")) {
            document.getElementById("foodex_questions").style.display = "none";
        }
        if (document.getElementById("booth_details_container")) {
            document.getElementById("booth_details_container").style.display = "none";
        }
        if (document.getElementById("visit_time_container")) {
            document.getElementById("visit_time_container").style.display = "none";
        }
        if (document.getElementById("visit_booth_message")) {
            document.getElementById("visit_booth_message").style.display = "none";
        }
        if (document.getElementById("additional_info_container")) {
            document.getElementById("additional_info_container").style.display = "none";
        }
        if (document.getElementById("thank_you_message")) {
            document.getElementById("thank_you_message").style.display = "none";
        }

        // ล้างค่าในฟิลด์ต่างๆ
        if (document.getElementById("foodex_event")) {
            document.getElementById("foodex_event").value = "";
        }
        if (document.getElementById("booth_details")) {
            document.getElementById("booth_details").value = "";
        }
        if (document.getElementById("visit_time")) {
            document.getElementById("visit_time").value = "";
        }
        if (document.getElementById("additional_info")) {
            document.getElementById("additional_info").value = "";
        }

        // ล้างตัวเลือกเพิ่มเติม
        const followUpContainer = document.getElementById("foodex_no_followup");
        if (followUpContainer) {
            followUpContainer.style.display = "none";
        }
    }

    // ฟังก์ชันสร้างตัวเลือกเพิ่มเติมสำหรับผู้ที่ไม่สามารถเข้าร่วม Foodex ได้
    function createFollowUpOptions() {
        // ตรวจสอบว่ามีคอนเทนเนอร์สำหรับตัวเลือกเพิ่มเติมหรือไม่
        let followupContainer = document.getElementById("foodex_no_followup");
        if (!followupContainer) {
            followupContainer = document.createElement("div");
            followupContainer.id = "foodex_no_followup";
            followupContainer.className = "mb-4";
            document.getElementById("foodex_meeting_container").insertAdjacentElement('afterend', followupContainer);
        }

        // แสดงตัวเลือกเพิ่มเติม
        followupContainer.style.display = "block";
        followupContainer.innerHTML = `
        <label class="form-label">
            <i class="fas fa-question-circle me-2"></i>Since you can't meet during Foodex Japan, What would you prefer?
        </label>
        <select class="form-select mb-3" id="no_meeting_preference" name="no_meeting_preference" onchange="handleNoMeetingPreference()">
            <option value="" selected>Please select an option</option>
            <option value="online_meeting">Arrange an online meeting at another time after Foodex Japan</option>
            <option value="company_info">Request company profile and sales kit to be sent through email.</option>
        </select>

        <!-- Container for online meeting options (initially hidden) -->
        <div id="online_meeting_options" style="display: none;">
            <div class="mb-3">
                <label for="online_meeting_date" class="form-label">
                    <i class="fas fa-calendar-alt me-2"></i>Preferred Date
                </label>
                <input type="date" class="form-control" id="online_meeting_date" name="online_meeting_date">
            </div>
            <div class="mb-3">
                <label for="online_meeting_time" class="form-label">
                    <i class="fas fa-clock me-2"></i>Preferred Time
                </label>
                <input type="time" class="form-control" id="online_meeting_time" name="online_meeting_time">
            </div>
        </div>

        <!-- Container for company info options (initially hidden) -->
        <div id="company_info_options" style="display: none;">
            <div class="mb-3">
                <label for="company_email_confirmation" class="form-label">
                    <i class="fas fa-envelope me-2"></i>Please confirm your company email
                </label>
                <input type="email" class="form-control" id="company_email_confirmation" name="company_email_confirmation">
            </div>
            <div class="mb-3">
                <label for="specific_info_request" class="form-label">
                    <i class="fas fa-info-circle me-2"></i>Any specific information you're looking for?
                </label>
                <textarea class="form-control" id="specific_info_request" name="specific_info_request" rows="3"></textarea>
            </div>
        </div>
    `;
    }

    // ฟังก์ชันจัดการตัวเลือกเพิ่มเติมสำหรับผู้ที่ไม่สามารถเข้าร่วม Foodex ได้
    function handleNoMeetingPreference() {
        const preference = document.getElementById("no_meeting_preference").value;
        const onlineMeetingOptions = document.getElementById("online_meeting_options");
        const companyInfoOptions = document.getElementById("company_info_options");

        // ซ่อนตัวเลือกทั้งสองก่อน
        if (onlineMeetingOptions) onlineMeetingOptions.style.display = "none";
        if (companyInfoOptions) companyInfoOptions.style.display = "none";

        // แสดงตัวเลือกตามการเลือก
        if (preference === "online_meeting") {
            onlineMeetingOptions.style.display = "block";
        } else if (preference === "company_info") {
            companyInfoOptions.style.display = "block";
        }
    }

    // ฟังก์ชันแสดงรายละเอียดตำแหน่ง booth
    function showLocationDetails() {
        const selectedLocation = document.getElementById("foodex_location").value;

        // ซ่อนรายละเอียดทั้งหมดก่อน
        hideAllLocationDetails();

        // แสดงรายละเอียดตามการเลือก
        if (selectedLocation === "Your Booth Exhibition Booth") {
            document.getElementById("your_booth_location_details").classList.remove("d-none");
        } else if (selectedLocation === "Other") {
            document.getElementById("other_location_details").classList.remove("d-none");
        }

        // แสดงฟิลด์วันที่และเวลาเสมอไม่ว่าจะเลือกตำแหน่งใด
        document.getElementById("question_jadjaan_date").style.display = "block";
        document.getElementById("question_time").style.display = "block";
    }

    // ฟังก์ชันซ่อนรายละเอียดตำแหน่ง booth ทั้งหมด
    function hideAllLocationDetails() {
        document.getElementById("your_booth_location_details").classList.add("d-none");
        document.getElementById("other_location_details").classList.add("d-none");

        // ล้างค่าในฟิลด์
        document.getElementById("your_booth_details").value = "";
        document.getElementById("other_location").value = "";
    }

</script>
@endpush
