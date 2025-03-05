@extends('frontend.layouts.master')

@section('title', 'url')
@section('css')
<style>
    .bought-before-no {
        display: none;
    }

    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 30px;
        color: #ddd;
        cursor: pointer;
        margin: 0 5px;
    }

    .star-rating label:hover,
    .star-rating label:hover~label,
    .star-rating input:checked~label {
        color: #ffcc00;
    }

    .rating-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
    }

</style>
<style>
    /* สไตล์สำหรับ range slider และการจัดวาง */
    .rating-container {
        margin: 20px 0;
        padding: 15px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .range-labels {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #666;
    }

    .custom-range {
        -webkit-appearance: none;
        width: 100%;
        height: 10px;
        border-radius: 5px;
        background: linear-gradient(to right, #ffcccb, #ffd93d, #a6e9a6);
        outline: none;
        margin: 15px 0;
    }

    .custom-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #ff6b6b;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.2s;
    }

    .custom-range::-webkit-slider-thumb:hover {
        transform: scale(1.1);
        background: #ff5252;
    }

    .custom-range::-moz-range-thumb {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #ff6b6b;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.2s;
        border: none;
    }

    .custom-range::-moz-range-thumb:hover {
        transform: scale(1.1);
        background: #ff5252;
    }

    .emoji-display {
        text-align: center;
        font-size: 2rem;
        margin: 15px 0;
        padding: 10px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .rating-markers {
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
    }

    .rating-markers span {
        font-weight: bold;
        color: #444;
    }

    /* สไตล์สำหรับปุ่ม Submit */
    .submit-container {
        margin-top: 30px;
        text-align: center;
    }

    .submit-button {
        background: linear-gradient(to right, #ff6b6b, #ffd93d);
        color: white;
        border: none;
        padding: 15px 40px;
        font-size: 1.2rem;
        font-weight: bold;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.5);
        background: linear-gradient(to right, #ff5252, #ffcd38);
    }

    .submit-button:active {
        transform: translateY(1px);
        box-shadow: 0 2px 10px rgba(255, 107, 107, 0.4);
    }

    .submit-icon {
        margin-right: 10px;
        font-size: 1.4rem;
    }

    .submit-text {
        letter-spacing: 0.5px;
    }

    /* ปรับแต่ง animation สำหรับปุ่ม submit */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .submit-button:hover .submit-icon {
        animation: pulse 1s infinite;
    }

    /* สไตล์สำหรับ radio button แบบ Bootstrap */
    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding-left: 0;
        margin-left: 25px;
    }

    .form-check-input[type="radio"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #ddd;
        border-radius: 50%;
        outline: none;
        margin-right: 10px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: white;
    }

    .form-check-input[type="radio"]:checked {
        border-color: #ff6b6b;
        background-color: white;
    }

    .form-check-input[type="radio"]:checked:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ff6b6b;
    }

    .form-check-input[type="radio"]:hover {
        border-color: #ffd93d;
    }

    .form-check-label {
        margin-bottom: 0;
        cursor: pointer;
    }

    /* สไตล์สำหรับช่องข้อความเพิ่มเติมของตัวเลือก Others */
    .form-other-input {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        margin-left: 10px;
        width: 100%;
        max-width: 300px;
        transition: all 0.3s;
    }

    .form-other-input:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
        outline: none;
    }

    /* จัดรูปแบบกลุ่มคำถาม */
    .question-container {
        margin-bottom: 25px;
        border-left: 3px solid #ffd93d;
        padding-left: 15px;
    }

    .question-title {
        font-weight: 500;
        margin-bottom: 15px;
        color: #333;
    }

</style>
<style>
    /* Custom Checkbox Styling */
    input[type="checkbox"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #ddd;
        border-radius: 4px;
        outline: none;
        margin-right: 10px;
        position: relative;
        cursor: pointer;
        vertical-align: middle;
        transition: all 0.3s ease;
        background-color: white;
    }

    input[type="checkbox"]:checked {
        border-color: #ff6b6b;
        background-color: #ff6b6b;
    }

    input[type="checkbox"]:checked:after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 14px;
        font-weight: bold;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    input[type="checkbox"]:hover {
        border-color: #ffd93d;
    }

    /* จัดรูปแบบของ label ที่อยู่ติดกับ checkbox */
    input[type="checkbox"]+label {
        display: inline-block;
        padding: 5px 10px 5px 5px;
        cursor: pointer;
        vertical-align: middle;
        transition: color 0.3s ease;
    }

    input[type="checkbox"]:checked+label {
        color: #333;
        font-weight: 500;
    }

    /* จัดรูปแบบตัวเลือก "Others" */
    .checkbox-others {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .checkbox-others input[type="text"] {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        margin-left: 10px;
        flex-grow: 1;
        transition: all 0.3s ease;
    }

    .checkbox-others input[type="text"]:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.15);
        outline: none;
    }

    /* จัดรูปแบบกรอบรวมตัวเลือก */
    .checkbox-group {
        margin-bottom: 20px;
        padding: 10px 0;
        border-left: 3px solid #ffd93d;
        padding-left: 15px;
    }

    .checkbox-option {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    /* จัดรูปแบบหัวข้อคำถาม */
    .question-title {
        font-weight: 500;
        margin-bottom: 15px;
        color: #333;
        padding-bottom: 5px;
        border-bottom: 1px solid #ffd93d;
    }

    h3 {
        color: red;
        margin-bottom: 20px;

    }

</style>
@endsection

@section('content')
<section class="fp__faq pt_100 xs_pt_70 pb_100 xs_pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 wow fadeInUp">
                <div class="card" style="margin-top: 80px;">
                    <div class="card-body">
                        <div class="container">
                            <img src="{{ asset('frontend/images/jadjaan_logo.png') }}" alt="JadJaan Logo" style="display: block; margin: auto; max-width: 100%; height: auto;">

                            <form id="surveyForm" action="{{ route('survey.store') }}" method="POST">
                                @csrf
                                <!-- Introduction Section -->
                                <div class="section" id="introSection">
                                    <h2 style="color: black;">Survey Objective</h2>
                                    <p>Gathering insights for <strong>JadJaan</strong> product improvement.</p>
                                    {{-- ข้อ 1 --}}
                                    <div class="question-container">
                                        <h4 class="question-title">1.FirstName</h4>
                                        <input type="text" id="firstname" name="firstname" required>
                                    </div>
                                    {{-- ข้อ 2 --}}
                                    <div class="question-container">
                                        <h4 class="question-title">2.LastName</h4>
                                        <input type="email" id="lastname" name="lastname" required>
                                    </div>
                                </div>

                                <!-- Section 1: Demographics -->
                                <div class="section" id="demographicsSection">
                                    <h3>Section 1: Demographics</h3>

                                    {{-- <div class="question-container">
                                        <h4 class="question-title">1. Which nation do you belong to?</h4>
                                        <input type="text" id="nation" name="nation">
                                    </div> --}}

                                    <!-- ตัวอย่างการใช้งานกับคำถามอายุ -->
                                    <div class="question-container">
                                        <h4 class="question-title">3. Age Group</h4>
                                        @foreach($ageGroup as $age)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="age_{{ $age->id }}" name="age_group" value="{{ $age->name_eng }}">
                                            <label class="form-check-label" for="age_{{ $age->id }}">{{ $age->name_eng }}</label>
                                        </div>
                                        @endforeach
                                    </div>

                                    <!-- ตัวอย่างการใช้งานกับคำถามเพศ -->
                                    <div class="question-container">
                                        <h4 class="question-title">4. Gender</h4>
                                        @foreach($Gender as $gender)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="gender_{{ $gender->id }}" name="gender_group" value="{{ $gender->name_eng }}">
                                            <label class="form-check-label" for="gender_{{ $gender->id }}">{{ $gender->name_eng }}</label>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="question-container">
                                        <h4 class="question-title">5. Household Type</h4>

                                        @foreach($HouseHoldType as $household)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="household_{{ $household->id }}" name="household_type" value="{{ $household->name_eng }}" onchange="checkHouseholdOther(this)">
                                            <label class="form-check-label" for="household_{{ $household->id }}">{{ $household->name_eng }}</label>

                                            <!-- ถ้าเป็น Others ให้แสดง input ในบรรทัดเดียวกัน -->
                                            @if($household->name_eng == 'Others')
                                            <span id="other_household_container" style="display: none; margin-left: 10px;">
                                                <input type="text" id="other_household" name="other_household" class="form-other-input" placeholder="Please specify">
                                            </span>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>

                                    {{-- ข้อ 6 --}}
                                    <div class="question-container">
                                        <h4 class="question-title">6. Nationality</h4>
                                        <select class="form-select" aria-label="Default select example" id="Nationality" name="Nationality" onchange="checkOtherNationality(this)" required>
                                            <option selected value="">Select a country</option>
                                            @foreach($country as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                            <option value="other">Others</option>
                                        </select>

                                        <div id="other_nationality_container" style="margin-top: 10px; display: none;">
                                            <input type="text" id="other_nationality" name="other_nationality" class="form-control" placeholder="Please specify your nationality">
                                        </div>
                                    </div>


                                    {{-- ข้อ 7 --}}
                                    <div class="question-container">
                                        <h4 class="question-title">7. Residential Country</h4>
                                        <select class="form-select" aria-label="Default select example" id="Country" name="Country" required>
                                            <option selected value="">Select a country</option>
                                            @foreach($country as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- ข้อ 8-->
                                    <div class="question-container">
                                        <h4 class="question-title">8. Have you ever tasted Thai food before?</h4>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="taste_thai_food_yes" name="taste_thai_food" value="Yes">
                                            <label class="form-check-label" for="taste_thai_food_yes">Yes</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="taste_thai_food_no" name="taste_thai_food" value="No">
                                            <label class="form-check-label" for="taste_thai_food_no">No</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Thai Food - Eating Habits (for those who have tried Thai food) -->
                                <div class="section hidden " id="thaiEatingHabitsSection">
                                    <h3>Section 2: Thai Food - Eating Habits</h3>

                                    {{-- ข้อ 9 --}}
                                    <div class="question-container thai-food-experience">
                                        <h4 class="question-title">9. How often do you eat Thai food?</h4>
                                        @foreach($ThaiFoods as $thaifood)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="thaifood_{{ $thaifood->id }}" name="thaifood_type" value="{{ $thaifood->name_eng }}" onchange="checkThaiOther(this)">
                                            <label class="form-check-label" for="thaifood_{{ $thaifood->id }}">{{ $thaifood->name_eng }}</label>

                                            @if($thaifood->name_eng == 'Others')
                                            <input type="text" id="other_thaifood" name="other_thaifood" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>


                                    {{-- ข้อ 10 --}}
                                    <div class="question thai-food-experience">
                                        <h4 class="question-title">10. Where do you usually eat Thai food?</h4>
                                        <div class="checkbox-group">
                                            <!-- กำหนดตัวเลือกแบบ hard-coded -->
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_1" name="eatthaifood_type[]" value="At home">
                                                <label class="form-check-label" for="eatthaifood_1">Restaurants</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_2" name="eatthaifood_type[]" value="Thai restaurant">
                                                <label class="form-check-label" for="eatthaifood_2">Home (cook myself)</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_3" name="eatthaifood_type[]" value="Food court">
                                                <label class="form-check-label" for="eatthaifood_3">Takeout/Delivery</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_4" name="eatthaifood_type[]" value="Street food">
                                                <label class="form-check-label" for="eatthaifood_4">Food trucks</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_5" name="eatthaifood_type[]" value="Street food">
                                                <label class="form-check-label" for="eatthaifood_5">Street vendors</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_6" name="eatthaifood_type[]" value="Street food">
                                                <label class="form-check-label" for="eatthaifood_6">Cafeteria/Workplace dining</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_7" name="eatthaifood_type[]" value="Street food">
                                                <label class="form-check-label" for="eatthaifood_7">Friends' or family's home</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_8" name="eatthaifood_type[]" value="Street food">
                                                <label class="form-check-label" for="eatthaifood_8">Special events (e.g., festivals, parties)</label>
                                            </div>

                                            <!-- เพิ่มตัวเลือก Others พร้อมช่องกรอกข้อมูล -->
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="eatthaifood_other" name="eatthaifood_type[]" value="Others" onchange="toggleOtherEatThaiFood(this.checked)">
                                                <label class="form-check-label" for="eatthaifood_other">Others</label>
                                                <input type="text" id="other_eatthaifood" name="other_eatthaifood" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ข้อ 11 --}}
                                    <div class="question thai-food-experience">
                                        <h4 class="question-title">11. If you were to cook or had to cook Thai food, what challenges would you face?</h4>
                                        <div class="checkbox-group">
                                            @foreach($challenges as $challenger)
                                            <div class="checkbox-option">
                                                @if(strtolower($challenger->name_eng) == 'other' || strtolower($challenger->name_eng) == 'others')
                                                <!-- ตัวเลือก Other ที่มาจากฐานข้อมูล -->
                                                <input class="form-check-input" type="checkbox" id="challenger_{{ $challenger->id }}" name="challenger_type[]" value="{{ $challenger->name_eng }}" onchange="toggleOtherChallenger(this.checked)">
                                                <label class="form-check-label" for="challenger_{{ $challenger->id }}">{{ $challenger->name_eng }}</label>
                                                <input type="text" id="other_challenger" name="other_challenger" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <!-- ตัวเลือกปกติ -->
                                                <input class="form-check-input" type="checkbox" id="challenger_{{ $challenger->id }}" name="challenger_type[]" value="{{ $challenger->name_eng }}">
                                                <label class="form-check-label" for="challenger_{{ $challenger->id }}">{{ $challenger->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ข้อ 12  กด YES ไปข้อ 17, 18, 19, 20 กด No ไป 21, 22, 20 --}}
                                    <div class="question-container thai-food-experience">
                                        <h4 class="question-title">12. Have you ever bought Thai Ready-to-cook products before?</h4>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="bought_before_yes" name="bought_before" value="Yes">
                                            <label class="form-check-label" for="bought_before_yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="bought_before_no" name="bought_before" value="No">
                                            <label class="form-check-label" for="bought_before_no">No</label>
                                        </div>
                                    </div>

                                    {{-- ข้อ 13 --}}
                                    <div class="question never-tried-thai-food">
                                        <h4 class="question-title">13. What is the reason you have never tried Thai food? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article13 as $article13)
                                            <div class="checkbox-option">
                                                @if(strtolower($article13->name_eng) == 'other' || strtolower($article13->name_eng) == 'others')
                                                <input class="form-check-input" type="checkbox" id="article13_{{ $article13->id }}" name="article13_type[]" value="{{ $article13->name_eng }}" onchange="toggleOtherInput('other_article13', this.checked)">
                                                <label class="form-check-label" for="article13_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                                <input type="text" id="other_article13" name="other_article13" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="article13_{{ $article13->id }}" name="article13_type[]" value="{{ $article13->name_eng }}">
                                                <label class="form-check-label" for="article13_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ข้อ 14 --}}
                                    <div class="question never-tried-thai-food">
                                        <h4 class="question-title">14. If you were to try Thai food, what type of food would you like to try? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article13 as $article13)
                                            <div class="checkbox-option">
                                                @if(strtolower($article13->name_eng) == 'other' || strtolower($article13->name_eng) == 'others')
                                                <input class="form-check-input" type="checkbox" id="article14_{{ $article13->id }}" name="article14_type[]" value="{{ $article13->name_eng }}" onchange="toggleOtherInput('other_article14', this.checked)">
                                                <label class="form-check-label" for="article14_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                                <input type="text" id="other_article14" name="other_article14" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="article14_{{ $article13->id }}" name="article14_type[]" value="{{ $article13->name_eng }}">
                                                <label class="form-check-label" for="article14_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ข้อ 15 --}}
                                    <div class="question never-tried-thai-food">
                                        <h4 class="question-title">15. If you were to try Thai food, which type of product or platform would you prefer to have Thai cuisine served on? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article13 as $article13)
                                            <div class="checkbox-option">
                                                @if(strtolower($article13->name_eng) == 'other' || strtolower($article13->name_eng) == 'others')
                                                <input class="form-check-input" type="checkbox" id="article15_{{ $article13->id }}" name="article15_type[]" value="{{ $article13->name_eng }}" onchange="toggleOtherInput('other_article15', this.checked)">
                                                <label class="form-check-label" for="article15_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                                <input type="text" id="other_article15" name="other_article15" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="article15_{{ $article13->id }}" name="article15_type[]" value="{{ $article13->name_eng }}">
                                                <label class="form-check-label" for="article15_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ข้อ 16 --}}
                                    <div class="question never-tried-thai-food">
                                        <h4 class="question-title">16. If you were to purchase Thai food or Thai products, what price range would you prefer?</h4>
                                        @foreach($Article13 as $article13)
                                        <div class="form-check">
                                            @if(strtolower($article13->name_eng) == 'other' || strtolower($article13->name_eng) == 'others')
                                            <input class="form-check-input article16-option" type="radio" id="article16_{{ $article13->id }}" name="article13_type" value="{{ $article13->name_eng }}" onchange="toggleOtherInput('other_article16', this.checked); showQuestion26();">
                                            <label class="form-check-label" for="article16_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                            <input type="text" id="other_article16" name="other_article16" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                            @else
                                            <input class="form-check-input article16-option" type="radio" id="article16_{{ $article13->id }}" name="article13_type" value="{{ $article13->name_eng }}" onchange="showQuestion26();">
                                            <label class="form-check-label" for="article16_{{ $article13->id }}">{{ $article13->name_eng }}</label>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Section 3: Preferences (Different sections based on previous answer) -->
                                <div class="section hidden bought-before-yes" id="preferencesSection">
                                    <h3>Section 3: Preferences for Thai Ready-to-Cook Products</h3>

                                    <!-- ข้อ 17 -->
                                    <div class="question bought-before-yes">
                                        <h4 class="question-title">17. What is your purpose for buying Thai Ready-to-Cook products? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article17 as $article17)
                                            <div class="checkbox-option">
                                                @if(strtolower($article17->name_eng) == 'other' || strtolower($article17->name_eng) == 'others')
                                                <input class="form-check-input" type="checkbox" id="article17_{{ $article17->id }}" name="article15_type[]" value="{{ $article17->name_eng }}" onchange="toggleOtherInput('other_article17', this.checked)">
                                                <label class="form-check-label" for="article17_{{ $article17->id }}">{{ $article17->name_eng }}</label>
                                                <input type="text" id="other_article17" name="other_article17" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="article17_{{ $article17->id }}" name="article15_type[]" value="{{ $article17->name_eng }}">
                                                <label class="form-check-label" for="article17_{{ $article17->id }}">{{ $article17->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- ข้อ 18 -->
                                    <div class="question bought-before-yes">
                                        <h4 class="question-title">18. What appeals to you most in Thai Ready-to-cook products? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article18 as $article18)
                                            <div class="checkbox-option">
                                                @if(strtolower($article18->name_eng) == 'other' || strtolower($article18->name_eng) == 'others')
                                                <input class="form-check-input" type="checkbox" id="article18_{{ $article18->id }}" name="article15_type[]" value="{{ $article18->name_eng }}" onchange="toggleOtherInput('other_article18', this.checked)">
                                                <label class="form-check-label" for="article18_{{ $article18->id }}">{{ $article18->name_eng }}</label>
                                                <input type="text" id="other_article18" name="other_article18" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="article18_{{ $article18->id }}" name="article15_type[]" value="{{ $article18->name_eng }}">
                                                <label class="form-check-label" for="article18_{{ $article18->id }}">{{ $article18->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- ข้อ 19 -->
                                    <div class="question bought-before-yes">
                                        <h4 class="question-title">19. What types of Thai dishes would you like as ready-to-cook products? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article19 as $article19)
                                            <div class="checkbox-option">
                                                @if(strtolower($article19->name_eng) == 'other' || strtolower($article19->name_eng) == 'others')
                                                <input class="form-check-input" type="checkbox" id="article19_{{ $article19->id }}" name="article19_type[]" value="{{ $article19->name_eng }}" onchange="toggleOtherInput('other_article19', this.checked)">
                                                <label class="form-check-label" for="article19_{{ $article19->id }}">{{ $article19->name_eng }}</label>
                                                <input type="text" id="other_article19" name="other_article19" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="article19_{{ $article19->id }}" name="article19_type[]" value="{{ $article19->name_eng }}">
                                                <label class="form-check-label" for="article19_{{ $article19->id }}">{{ $article19->name_eng }}</label>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ข้อ 20 --}}
                                    <div class="">
                                        <h4 class="question bought-before-yes">20. Would you consider buying a Thai Ready-to-Cook product if it were available in your area?</h4>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="ready_to_clook_yes" name="ready_to_cook" value="Yes">
                                            <label for="">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="ready_to_clook_no" name="ready_to_cook" value="No">
                                            <label for="">No</label>
                                        </div>
                                    </div>

                                    {{-- ข้อ 21 --}}
                                    <div class="question bought-before-no">
                                        <h4 class="question-title">21. What are the reasons you have not purchased Thai Ready-to-Cook products? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            @foreach($Article21 as $article21)
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="article21_{{ $article21->id }}" name="article21_type[]" value="{{ $article21->name_eng }}">
                                                <label class="form-check-label" for="article21_{{ $article21->id }}">{{ $article21->name_eng }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ข้อ 22 --}}
                                    <div class="question bought-before-no">
                                        <h4 class="question-title">22. If you were to purchase a Thai Ready-to-Cook product, what aspects would most appeal to you? (Tick all that apply)
                                        </h4>
                                        @foreach($Article22 as $article22)
                                        <div class="checkbox-option">
                                            <input class="form-check-input" type="checkbox" id="article22_{{ $article22->id }}" name="article22_type[]" value="{{ $article22->name_eng }}">
                                            <label class="form-check-label" for="article22_{{ $article22->id }}">{{ $article22->name_eng }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Section 4: Shopping Behavior -->
                                <div class="section hidden" id="shoppingBehaviorSection">
                                    <h3>Section 4: Shopping Behavior</h3>

                                    {{-- ข้อ 23 --}}
                                    <div class="question-container advanced-questions">
                                        <h4 class="question-title">23. In which country do you buy Thai Ready-to-Cook products?</h4>
                                        @foreach($Article23 as $article23)
                                        <div class="checkbox-option">
                                            @if(strtolower($article23->name_eng) == 'other' || strtolower($article23->name_eng) == 'others')
                                            <input class="form-check-input" type="checkbox" id="article23_{{ $article23->id }}" name="article23_type[]" value="{{ $article23->name_eng }}" onchange="toggleOtherInput('other_article23', this.checked)">
                                            <label class="form-check-label" for="article23_{{ $article23->id }}">{{ $article23->name_eng }}</label>
                                            <input type="text" id="other_article23" name="other_article23" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                            @else
                                            <input class="form-check-input" type="checkbox" id="article23_{{ $article23->id }}" name="article23_type[]" value="{{ $article23->name_eng }}">
                                            <label class="form-check-label" for="article23_{{ $article23->id }}">{{ $article23->name_eng }}</label>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>

                                    {{-- ข้อ 24 --}}
                                    <div class="question advanced-questions">
                                        <h4 class="question-title">24. Where do you usually purchase Thai Ready-to-Cook products? (Tick all that apply)</h4>
                                        <div class="checkbox-group">
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="purchase_location_1" name="purchase_location[]" value="Supermarkets">
                                                <label class="form-check-label" for="purchase_location_1">Supermarkets</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="purchase_location_2" name="purchase_location[]" value="Convenience stores">
                                                <label class="form-check-label" for="purchase_location_2">Convenience stores (e.g., 7-11, Lawson)</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="purchase_location_3" name="purchase_location[]" value="Online stores">
                                                <label class="form-check-label" for="purchase_location_3">Online stores</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="purchase_location_4" name="purchase_location[]" value="Specialty stores">
                                                <label class="form-check-label" for="purchase_location_4">Specialty stores (e.g., Thai grocery)</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input class="form-check-input" type="checkbox" id="purchase_location_other" name="purchase_location[]" value="Others" onchange="toggleOtherInput('other_purchase_location', this.checked)">
                                                <label class="form-check-label" for="purchase_location_other">Others</label>
                                                <input type="text" id="other_purchase_location" name="other_purchase_location" class="form-other-input" placeholder="Please specify" style="display: none; margin-left: 10px;">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ข้อ 25 --}}
                                    <div class="question-container advanced-questions">
                                        <h4 class="question-title">25. How much are you willing to spend on a ready-to-cook Thai product (Package for 2 Servings)?</h4>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="price_range_1" name="price_range" value="Under ¥500 (Under $5)">
                                                <label class="form-check-label" for="price_range_1">Under ¥500 (Under $5)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="price_range_2" name="price_range" value="¥500 - ¥1,000 ($5 - $8)">
                                                <label class="form-check-label" for="price_range_2">¥500 - ¥1,000 ($5 - $8)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="price_range_3" name="price_range" value="¥1,000 - ¥1,500 ($9 - $13)">
                                                <label class="form-check-label" for="price_range_3">¥1,000 - ¥1,500 ($9 - $13)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="price_range_4" name="price_range" value="Over ¥1,500 (Over $13)">
                                                <label class="form-check-label" for="price_range_4">Over ¥1,500 (Over $13)</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ข้อ 26 --}}
                                    <div id="question26" class="question" style="display: none;">
                                        <h4 class="question-title">26. Have you ever tried Thai Ready-to-Cook products?</h4>
                                        <div class="radio-group">
                                            <div class="radio-option">
                                                <input class="form-check-input" type="radio" id="tried_sample_yes" name="question26" value="Yes">
                                                <label class="form-check-label" for="tried_sample_yes">Yes</label>
                                            </div>
                                            <div class="radio-option">
                                                <input class="form-check-input" type="radio" id="tried_sample_no" name="question26" value="No">
                                                <label class="form-check-label" for="tried_sample_no">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ข้อ 27 --}}
                                    <div class="question-container advanced-questions">
                                        <h4 class="question-title">27. What factors wouldmake you reconsiderpurchasing ThaiReady-to-Cookproducts? (Tick allthat apply)</h4>

                                    </div>
                                </div>

                                <!-- Section 5: Jad Jaan Ready-to-Cook Products -->
                                <div class="section hidden" id="jadjaanProductsSection">
                                    <h3>Section 5: Jad Jaan Ready-to-Cook Products</h3>

                                    <div id="jadjaanProductsSection" class="question-group" style="display: none;">
                                        {{-- ข้อ 28 --}}
                                        <div class="question advanced-questions">
                                            <h4 class="question-title">28. Which JadJaan menu item have you tried? (Tick all that apply)</h4>
                                            <div class="checkbox-group">
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_1" name="jadjaan_menu[]" value="Northern Thai Curry Noodle Soup (Khao Soi)">
                                                    <label class="form-check-label" for="menu_1">Northern Thai Curry Noodle Soup (Khao Soi)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_2" name="jadjaan_menu[]" value="Rice Vermicelli with Curry (Kanom Jeen)">
                                                    <label class="form-check-label" for="menu_2">Rice Vermicelli with Curry (Kanom Jeen)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_3" name="jadjaan_menu[]" value="Hot and Sour Soup (Tom Yum)">
                                                    <label class="form-check-label" for="menu_3">Hot and Sour Soup (Tom Yum)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_4" name="jadjaan_menu[]" value="Coconut Soup (Tom Kha)">
                                                    <label class="form-check-label" for="menu_4">Coconut Soup (Tom Kha)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_5" name="jadjaan_menu[]" value="Bamboo Spicy Soup (Gaeng Nor Mai)">
                                                    <label class="form-check-label" for="menu_5">Bamboo Spicy Soup (Gaeng Nor Mai)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_6" name="jadjaan_menu[]" value="Green Curry (Gaeng Khiew Wan)">
                                                    <label class="form-check-label" for="menu_6">Green Curry (Gaeng Khiew Wan)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_7" name="jadjaan_menu[]" value="Golden Apple Snail with Betel Leaves Curry (Gaeng Khua Hoy)">
                                                    <label class="form-check-label" for="menu_7">Golden Apple Snail with Betel Leaves Curry (Gaeng Khua Hoy)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_8" name="jadjaan_menu[]" value="Massaman Curry (Massaman Curry)">
                                                    <label class="form-check-label" for="menu_8">Massaman Curry (Massaman Curry)</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="menu_9" name="jadjaan_menu[]" value="Panang Curry (Panang Curry)">
                                                    <label class="form-check-label" for="menu_9">Panang Curry (Panang Curry)</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ข้อ 29 --}}
                                        <div class="question advanced-questions">
                                            <h4 class="question-title">29. Please rate the taste of JadJaan sample on a scale of 1 to 5 (1 = Very Poor, 5 = Excellent)</h4>
                                            <div class="rating-container">
                                                <div class="range-labels">
                                                    <span>1 - Very Poor</span>
                                                    <span>5 - Excellent</span>
                                                </div>
                                                <input type="range" id="taste_sample_rating" name="taste_sample_rating" min="1" max="5" value="3" class="custom-range" oninput="updateTasteSampleEmoji(this.value)">
                                                <div id="taste_sample_emoji_display" class="emoji-display">😐 3</div>
                                                <div class="rating-markers">
                                                    <span>1</span>
                                                    <span>2</span>
                                                    <span>3</span>
                                                    <span>4</span>
                                                    <span>5</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ข้อ 30 --}}
                                        <div class="question advanced-questions">
                                            <h4 class="question-title">30. What serving size would you prefer for JadJaan products?</h4>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="serving_size_1" name="serving_size" value="Single-serving">
                                                    <label class="form-check-label" for="serving_size_1">Single-serving</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="serving_size_2" name="serving_size" value="Couple-serving (2 servings)">
                                                    <label class="form-check-label" for="serving_size_2">Couple-serving (2 servings)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="serving_size_3" name="serving_size" value="Family-serving (3-5 servings)">
                                                    <label class="form-check-label" for="serving_size_3">Family-serving (3-5 servings)</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ข้อ 31 --}}
                                        <div class="question advanced-questions">
                                            <h4 class="question-title">31. What future products of JadJaan would you like to see? (Tick all that apply)</h4>
                                            <div class="checkbox-group">
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="future_product_1" name="future_products[]" value="More curry varieties">
                                                    <label class="form-check-label" for="future_product_1">More curry varieties</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="future_product_2" name="future_products[]" value="Stir-fry dishes">
                                                    <label class="form-check-label" for="future_product_2">Stir-fry dishes</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="future_product_3" name="future_products[]" value="Thai salads">
                                                    <label class="form-check-label" for="future_product_3">Thai salads</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="future_product_4" name="future_products[]" value="Thai desserts">
                                                    <label class="form-check-label" for="future_product_4">Thai desserts</label>
                                                </div>
                                                <div class="checkbox-option">
                                                    <input class="form-check-input" type="checkbox" id="future_product_5" name="future_products[]" value="Thai beverages">
                                                    <label class="form-check-label" for="future_product_5">Thai beverages</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ข้อ 32 --}}
                                        <div class="question advanced-questions">
                                            <h4 class="question-title">32. Do you have any suggestions for improving JadJaan products?</h4>
                                            <textarea class="form-control" id="improvement_suggestions" name="improvement_suggestions" rows="4" placeholder="Please share your suggestions here..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div id="questions-33-to-36" class="question-group" style="display: none;">
                                    {{-- ข้อ 33 --}}
                                    <div class="question advanced-questions">
                                        <h4 class="question-title">33. How would you rate the package design of JadJaan? Rate on a scale of 1 to 5 (1 = Very Poor, 5 = Excellent)</h4>
                                        <div class="rating-container">
                                            <div class="range-labels">
                                                <span>1 - Very Poor</span>
                                                <span>5 - Excellent</span>
                                            </div>
                                            <input type="range" id="package_design_rating" name="package_design_rating" min="1" max="5" value="3" class="custom-range" oninput="updatePackageDesignEmoji(this.value)">
                                            <div id="package_design_emoji_display" class="emoji-display">😐 3</div>
                                            <div class="rating-markers">
                                                <span>1</span>
                                                <span>2</span>
                                                <span>3</span>
                                                <span>4</span>
                                                <span>5</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ข้อ 34 --}}
                                    <div class="question advanced-questions">
                                        <h4 class="question-title">34. How would you rate the booth design of JadJaan on a scale of 1 to 5 (1 = Very Poor, 5 = Excellent)?</h4>
                                        <div class="rating-container">
                                            <div class="range-labels">
                                                <span>1 - Very Poor</span>
                                                <span>5 - Excellent</span>
                                            </div>
                                            <input type="range" id="booth_design_rating" name="booth_design_rating" min="1" max="5" value="3" class="custom-range" oninput="updateBoothDesignEmoji(this.value)">
                                            <div id="booth_design_emoji_display" class="emoji-display">😐 3</div>
                                            <div class="rating-markers">
                                                <span>1</span>
                                                <span>2</span>
                                                <span>3</span>
                                                <span>4</span>
                                                <span>5</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ข้อ 35 --}}
                                    <div class="question advanced-questions">
                                        <h4 class="question-title">35. How would you rate the overall experience of the JadJaan booth on a scale of 1 to 5 (1 = Very Poor, 5 = Excellent)?</h4>
                                        <div class="rating-container">
                                            <div class="range-labels">
                                                <span>1 - Very Poor</span>
                                                <span>5 - Excellent</span>
                                            </div>
                                            <input type="range" id="overall_experience_rating" name="overall_experience_rating" min="1" max="5" value="3" class="custom-range" oninput="updateOverallExperienceEmoji(this.value)">
                                            <div id="overall_experience_emoji_display" class="emoji-display">😐 3</div>
                                            <div class="rating-markers">
                                                <span>1</span>
                                                <span>2</span>
                                                <span>3</span>
                                                <span>4</span>
                                                <span>5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="submit-container">
                            <button type="submit" class="submit-button">
                                <span class="submit-icon">✓</span>
                                <span class="submit-text">Submit Survey</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // แสดงเงื่อนไขตาม Flow
    document.addEventListener('DOMContentLoaded', function() {
        // ----- เริ่มต้น: ซ่อน section และคำถามที่ยังไม่ต้องการแสดง -----
        initializeSections();

        // ----- ตั้งค่า event listeners สำหรับการนำทางในแบบฟอร์ม -----
        setupThaiFood();
        setupReadyToCook();
        setupConsiderBuying();
        setupJadJaanSample();

        // ----- ฟังก์ชันตั้งค่าการแสดงผล section และคำถามต่างๆ -----
        function initializeSections() {
            // แสดงเฉพาะ Section 1 ตอนเริ่มต้น
            document.getElementById('demographicsSection').style.display = 'block';

            // ซ่อน Section 2-5
            document.getElementById('thaiEatingHabitsSection').style.display = 'none';
            document.getElementById('preferencesSection').style.display = 'none';
            document.getElementById('shoppingBehaviorSection').style.display = 'none';
            document.getElementById('jadjaanProductsSection').style.display = 'none';

            // ซ่อนคำถามเงื่อนไข
            hideElements('.thai-food-experience');
            hideElements('.never-tried-thai-food');
            hideElements('.bought-before-yes');
            hideElements('.bought-before-no');
            hideElements('.advanced-questions');
        }

        // ----- ข้อ 8: เคยทานอาหารไทยหรือไม่ -----
        function setupThaiFood() {
            const tasteThaiYes = document.getElementById('taste_thai_food_yes');
            const tasteThaiNo = document.getElementById('taste_thai_food_no');

            if (!tasteThaiYes || !tasteThaiNo) return;

            // เมื่อเลือก "Yes" - ไปที่ข้อ 9-12
            tasteThaiYes.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('thaiEatingHabitsSection').style.display = 'block';
                    showElements('.thai-food-experience');
                    hideElements('.never-tried-thai-food');
                    resetAnswers('.never-tried-thai-food');
                }
            });

            // เมื่อเลือก "No" - ไปที่ข้อ 13-16
            tasteThaiNo.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('thaiEatingHabitsSection').style.display = 'block';
                    hideElements('.thai-food-experience');
                    showElements('.never-tried-thai-food');
                    resetAnswers('.thai-food-experience');
                }
            });
        }

        // ----- ข้อ 12: เคยซื้อสินค้า ready-to-cook หรือไม่ -----
        function setupReadyToCook() {
            const boughtBeforeYes = document.getElementById('bought_before_yes');
            const boughtBeforeNo = document.getElementById('bought_before_no');


            if (!boughtBeforeYes || !boughtBeforeNo) return;

            // เมื่อเลือก "Yes" - ไปที่ข้อ 17-20
            boughtBeforeYes.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('preferencesSection').style.display = 'block';
                    showElements('.bought-before-yes');
                    hideElements('.bought-before-no');
                    resetAnswers('.bought-before-no');
                }
            });

            if (this.checked) {
                document.getElementById('thaiEatingHabitsSection').style.display = 'block';
                showElements('.thai-food-experience');
                hideElements('.never-tried-thai-food');
                resetAnswers('.never-tried-thai-food');
            }

            // เมื่อเลือก "No" - ไปที่ข้อ 21-22
            boughtBeforeNo.addEventListener('change', function() {
                if (this.checked) {
                    // แสดง Section 3 และข้อ 21-22
                    document.getElementById('preferencesSection').style.display = 'block';

                    // ซ่อนข้อ 17-20
                    document.querySelectorAll('.bought-before-yes').forEach(function(elem) {
                        elem.style.display = 'none';
                    });

                    // แสดงข้อ 21-22
                    document.querySelectorAll('.bought-before-no').forEach(function(elem) {
                        elem.style.display = 'block';
                        console.log("Set display:block for:", elem);
                    });
                }
            });
        }

        // ----- ข้อ 20: พิจารณาซื้อสินค้า ready-to-cook หรือไม่ -----
        function setupConsiderBuying() {
            // แก้ไขชื่อ ID ให้ถูกต้อง (จากโค้ด HTML ที่ให้มา)
            const readyToCookYes = document.getElementById('ready_to_clook_yes');
            const readyToCookNo = document.getElementById('ready_to_clook_no');

            if (!readyToCookYes || !readyToCookNo) {
                console.log("Cannot find ready_to_clook radio buttons");
                return;
            }

            // เมื่อเลือก "Yes" - ไปที่ Section 4 (ข้อ 23-27)
            readyToCookYes.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('shoppingBehaviorSection').style.display = 'block';
                    showElements('.advanced-questions');
                    console.log("'Yes' selected in question 20, showing Shopping Behavior section");
                }
            });
        }

        // ----- ข้อ 26: เคยลองสินค้า JadJaan หรือไม่ -----
        // ฟังก์ชันตั้งค่าการทำงานของการเลือกใน JadJaan Sample
        function setupJadJaanSample() {
            const triedSampleYes = document.getElementById('tried_sample_yes');
            const triedSampleNo = document.getElementById('tried_sample_no');

            if (!triedSampleYes) {
                console.log("Cannot find tried_sample_yes radio button");
                return;
            }

            // เมื่อเลือก "Yes" - แสดง Section สำหรับข้อ 28-36
            if (triedSampleYes) {
                triedSampleYes.addEventListener('change', function() {
                    if (this.checked) {
                        document.getElementById('jadjaanProductsSection').style.display = 'block';
                        console.log("'Yes' selected in question 26, showing JadJaan Products section");
                    }
                });
            }

            // เมื่อเลือก "No" - ให้ซ่อน Section สำหรับข้อ 28-32 และอาจจะแสดงเฉพาะข้อ 33-36 (ถ้ามี)
            if (triedSampleNo) {
                triedSampleNo.addEventListener('change', function() {
                    if (this.checked) {
                        // ถ้าคุณมีส่วนที่แยกสำหรับข้อ 33-36 คุณสามารถแสดงมันที่นี่
                        // document.getElementById('questions33to36Section').style.display = 'block';

                        // ซ่อนส่วนของข้อ 28-32
                        document.getElementById('jadjaanProductsSection').style.display = 'none';
                        console.log("'No' selected in question 26, hiding JadJaan Products section");
                    }
                });
            }
        }

        // ----- ฟังก์ชันช่วย (Helper functions) -----

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(elem) {
                elem.style.display = 'block';
            });
        }

        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(elem) {
                elem.style.display = 'none';
            });
        }

        function resetAnswers(selector) {
            const elements = document.querySelectorAll(selector);

            elements.forEach(function(elem) {
                // รีเซ็ต Radio buttons
                elem.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                    radio.checked = false;
                });

                // รีเซ็ต Checkboxes
                elem.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });

                // รีเซ็ต Text inputs และ Textareas
                elem.querySelectorAll('input[type="text"], textarea').forEach(function(input) {
                    input.value = '';
                });

                // รีเซ็ต Selects
                elem.querySelectorAll('select').forEach(function(select) {
                    select.selectedIndex = 0;
                });
            });
        }
    });

    // ฟังก์ชันสำหรับอัพเดท emoji ของแต่ละ rating scale
    function updateTasteSampleEmoji(value) {
        updateEmojiDisplay('taste_sample_emoji_display', value, 'Very Poor', 'Excellent');
    }

    function updateAuthenticityEmoji(value) {
        updateEmojiDisplay('authenticity_emoji_display', value, 'Very Poor', 'Excellent');
    }

    function updatePackageDesignEmoji(value) {
        updateEmojiDisplay('package_design_emoji_display', value, 'Very Poor', 'Excellent');
    }

    function updateBoothDesignEmoji(value) {
        updateEmojiDisplay('booth_design_emoji_display', value, 'Very Poor', 'Excellent');
    }

    function updateOverallExperienceEmoji(value) {
        updateEmojiDisplay('overall_experience_emoji_display', value, 'Very Poor', 'Excellent');
    }

    // ฟังก์ชันกลางสำหรับอัพเดท emoji
    function updateEmojiDisplay(elementId, value, lowLabel, highLabel) {
        const emoji = document.getElementById(elementId);
        if (!emoji) return;

        const val = parseInt(value);
        switch (val) {
            case 1:
                emoji.innerHTML = `😞 1 - ${lowLabel}`;
                emoji.style.backgroundColor = "#ffcccb";
                break;
            case 2:
                emoji.innerHTML = "🙁 2 - Poor";
                emoji.style.backgroundColor = "#ffe4cc";
                break;
            case 3:
                emoji.innerHTML = "😐 3 - Average";
                emoji.style.backgroundColor = "#fff7cc";
                break;
            case 4:
                emoji.innerHTML = "🙂 4 - Good";
                emoji.style.backgroundColor = "#e6ffcc";
                break;
            case 5:
                emoji.innerHTML = `😄 5 - ${highLabel}`;
                emoji.style.backgroundColor = "#ccffd8";
                break;
        }
    }

    // แสดง Input เมื่อเลือก Other
    function checkHouseholdOther(radio) {
        const otherContainer = document.getElementById('other_household_container');

        // ตรวจสอบว่าค่าที่เลือกเป็น "Others" หรือไม่
        if (radio.value === 'Others') {
            otherContainer.style.display = 'block';
            document.getElementById('other_household').focus();
        } else {
            otherContainer.style.display = 'none';
            document.getElementById('other_household').value = '';
        }
    }

    // ตรวจสอบค่าเริ่มต้นเมื่อโหลดหน้า
    document.addEventListener('DOMContentLoaded', function() {
        const checkedRadio = document.querySelector('input[name="household_type"]:checked');
        if (checkedRadio && checkedRadio.value === 'Others') {
            document.getElementById('other_household_container').style.display = 'block';
        }
    });

    function checkOtherNationality(select) {
        const otherContainer = document.getElementById('other_nationality_container');

        if (select.value === 'other') {
            otherContainer.style.display = 'block';
            document.getElementById('other_nationality').focus();
        } else {
            otherContainer.style.display = 'none';
            document.getElementById('other_nationality').value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const nationalitySelect = document.getElementById('Nationality');
        if (nationalitySelect && nationalitySelect.value === 'other') {
            document.getElementById('other_nationality_container').style.display = 'block';
        }
    });


    function checkThaiOther(radio) {
        // ตรวจสอบว่ามี input อื่นๆ ในหน้าหรือไม่
        const otherInput = document.getElementById('other_thaifood');
        if (!otherInput) return;

        if (radio.value === 'Others') {
            otherInput.style.display = 'inline-block';
            otherInput.focus();
        } else {
            otherInput.style.display = 'none';
            otherInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const checkedRadio = document.querySelector('input[name="thaifood_type"]:checked');
        if (checkedRadio && checkedRadio.value === 'Others') {
            const otherInput = document.getElementById('other_thaifood');
            if (otherInput) {
                otherInput.style.display = 'inline-block';
            }
        }
    });

    function toggleOtherEatThaiFood(isChecked) {
        const otherInput = document.getElementById('other_eatthaifood');
        if (isChecked) {
            otherInput.style.display = 'inline-block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = ''; // เคลียร์ค่าเมื่อยกเลิกการเลือก
        }
    }

    // ตรวจสอบตอนโหลดหน้า
    document.addEventListener('DOMContentLoaded', function() {
        const otherCheckbox = document.getElementById('eatthaifood_other');
        if (otherCheckbox && otherCheckbox.checked) {
            document.getElementById('other_eatthaifood').style.display = 'inline-block';
        }
    });

    function toggleOtherChallenger(isChecked) {
        const otherInput = document.getElementById('other_challenger');
        if (isChecked) {
            otherInput.style.display = 'inline-block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = ''; // เคลียร์ค่าเมื่อยกเลิกการเลือก
        }
    }

    function toggleOtherInput(inputId, isChecked) {
        const otherInput = document.getElementById(inputId);
        if (isChecked) {
            otherInput.style.display = 'inline-block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = ''; // เคลียร์ค่าเมื่อยกเลิกการเลือก
        }
    }

    // ฟังก์ชั่นสำหรับแสดงข้อ 26 เมื่อมีการเลือกคำตอบในข้อ 16
    function showQuestion26() {
        console.log("showQuestion26 function called");

        const question26Element = document.getElementById('question26');
        if (!question26Element) {
            console.error("Element with ID 'question26' not found");
            return;
        }
        question26Element.style.display = 'block';
    question26Element.style.visibility = 'visible';
    question26Element.style.opacity = '1';
    question26Element.style.position = 'static'; // หรือ 'relative' ขึ้นอยู่กับการจัดวาง

    // เพิ่มคลาส "active" หรือคลาสอื่นที่คุณอาจใช้เพื่อควบคุมการแสดง
    question26Element.classList.add('active');

    // ตรวจสอบ parent elements เพื่อให้แน่ใจว่าแสดง
    let parent = question26Element.parentElement;
    while (parent) {
        parent.style.display = 'block';
        parent.style.visibility = 'visible';
        parent = parent.parentElement;
    }
        console.log("Found question26 element, setting display to block");
        question26Element.style.display = 'block';

        // ซ่อน JadJaan section
        const jadjaanSection = document.getElementById('jadjaanProductsSection');
        if (jadjaanSection) {
            jadjaanSection.style.display = 'none';
        } else {
            console.warn("Element with ID 'jadjaanProductsSection' not found");
        }

        // เคลียร์การเลือกในข้อ 26
        const yesRadio = document.getElementById('tried_sample_yes');
        const noRadio = document.getElementById('tried_sample_no');

        if (yesRadio) {
            yesRadio.checked = false;
        } else {
            console.warn("Element with ID 'tried_sample_yes' not found");
        }

        if (noRadio) {
            noRadio.checked = false;
        } else {
            console.warn("Element with ID 'tried_sample_no' not found");
        }

        console.log("showQuestion26 function completed");
    }

    // ฟังก์ชั่นสำหรับจัดการการแสดงคำถามตามการเลือกในข้อ 26
    function handleQuestion26Selection(answer) {

        if ('answer') {
            // ถ้าเลือก Yes ให้แสดงข้อ 28-36
            document.getElementById('questions-28-to-32').style.display = 'block';
            document.getElementById('questions-33-to-36').style.display = 'block';
        } else if (answer === 'no') {
            // ถ้าเลือก No ให้แสดงเฉพาะข้อ 33-36
            document.getElementById('questions-28-to-32').style.display = 'none';
            document.getElementById('questions-33-to-36').style.display = 'block';
        }
    }

</script>
@endpush
