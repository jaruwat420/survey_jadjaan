@extends('frontend.layouts.master')

@section('title', 'url')
@section('css')
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

</style>
@endsection

@section('content')
<section class="fp__faq pt_100 xs_pt_70 pb_100 xs_pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 wow fadeInUp">
                <div class="container">
                    <img src="{{ asset('frontend/images/jadjaan_logo.png') }}" alt="JadJaan Logo" style="display: block; margin: auto; max-width: 100%; height: auto;">

                    <form id="surveyForm" action="{{ route('survey.store') }}" method="POST">
                        @csrf
                        <!-- Introduction Section -->
                        <div class="section" id="introSection">
                            <h2 style="color: black;">Survey Objective</h2>
                            <p>Gathering insights for <strong>JadJaan</strong> product improvement.</p>

                            <div class="question-container">
                                <h4 class="question-title">Name</h4>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="question-container">
                                <h4 class="question-title">Email</h4>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>

                        <!-- Section 1: Demographics -->
                        <div class="section" id="demographicsSection">
                            <h3>Section 1: Demographics</h3>

                            <div class="question-container">
                                <h4 class="question-title">1. Which nation do you belong to?</h4>
                                <input type="text" id="nation" name="nation">
                            </div>

                            <!-- ตัวอย่างการใช้งานกับคำถามอายุ -->
                            <div class="question-container">
                                <h4 class="question-title">2. Age Group</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="under_20" name="age_group" value="Under 20">
                                    <label class="form-check-label" for="under_20">Under 20</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="20_30" name="age_group" value="20-30">
                                    <label class="form-check-label" for="20_30">20–30</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="31_40" name="age_group" value="31-40">
                                    <label class="form-check-label" for="31_40">31–40</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="41_50" name="age_group" value="41-50">
                                    <label class="form-check-label" for="41_50">41–50</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="over_50" name="age_group" value="Over 50">
                                    <label class="form-check-label" for="over_50">Over 50</label>
                                </div>
                            </div>

                            <!-- ตัวอย่างการใช้งานกับคำถามเพศ -->
                            <div class="question-container">
                                <h4 class="question-title">3. Gender</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="Male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="prefer_not_to_say" name="gender" value="Prefer not to say">
                                    <label class="form-check-label" for="prefer_not_to_say">Prefer not to say</label>
                                </div>
                            </div>

                            <!-- ตัวอย่างการใช้งานกับคำถามประเภทครัวเรือน และมีตัวเลือก Others ที่มีช่องให้กรอกข้อมูลเพิ่มเติม -->
                            <div class="question-container">
                                <h4 class="question-title">4. Household Type</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="single" name="household_type" value="Single">
                                    <label class="form-check-label" for="single">Single</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="couple" name="household_type" value="Couple">
                                    <label class="form-check-label" for="couple">Couple</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="family_with_children" name="household_type" value="Family with children">
                                    <label class="form-check-label" for="family_with_children">Family with children</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="other_household_type" name="household_type" value="Others">
                                    <label class="form-check-label" for="other_household_type">Others</label>
                                    <input type="text" id="other_household" name="other_household" class="form-other-input" placeholder="Please specify">
                                </div>
                            </div>

                            <!-- ตัวอย่างคำถามเกี่ยวกับการลองอาหารไทย -->
                            <div class="question-container">
                                <h4 class="question-title">5. Have you ever tasted Thai food before?</h4>

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

                        <!-- Section 2.1: Never Tried Thai Food -->
                        <div class="section hidden" id="neverTriedSection">
                            <h3>Section 2.1: Never Tried Thai Food</h3>

                            <div class="question">
                                <h4 class="question-title">Q1. What is the reason you have never tried Thai food?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_not_familiar" name="reason_never_tried[]" value="Not familiar with Thai cuisine">
                                        <label for="reason_not_familiar">Not familiar with Thai cuisine</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_dont_like_spicy" name="reason_never_tried[]" value="Don't like spicy food">
                                        <label for="reason_dont_like_spicy">Don't like spicy food</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_concerned_ingredients" name="reason_never_tried[]" value="Concerned about ingredients">
                                        <label for="reason_concerned_ingredients">Concerned about ingredients</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_no_access" name="reason_never_tried[]" value="No access to Thai restaurants or products">
                                        <label for="reason_no_access">No access to Thai restaurants or products</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_price_high" name="reason_never_tried[]" value="Price is too high">
                                        <label for="reason_price_high">Price is too high</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="reason_other" name="reason_never_tried[]" value="Other">
                                        <label for="reason_other">Other</label>
                                        <input type="text" id="other_reason" name="other_reason" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>

                            <div class="question">
                                <h4 class="question-title">Q2. If you were to try Thai food, what type of food would you like to try?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="food_type_soup" name="food_type_to_try[]" value="Soup">
                                        <label for="food_type_soup">Soup</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="food_type_noodles" name="food_type_to_try[]" value="Noodles">
                                        <label for="food_type_noodles">Noodles</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="food_type_stir_fried" name="food_type_to_try[]" value="Stir-fried">
                                        <label for="food_type_stir_fried">Stir-fried</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="food_type_curry" name="food_type_to_try[]" value="Curry">
                                        <label for="food_type_curry">Curry</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="food_type_pasta" name="food_type_to_try[]" value="Pasta">
                                        <label for="food_type_pasta">Pasta</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="food_type_deep_fried" name="food_type_to_try[]" value="Deep-fried">
                                        <label for="food_type_deep_fried">Deep-fried</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="food_type_other" name="food_type_to_try[]" value="Other">
                                        <label for="food_type_other">Other</label>
                                        <input type="text" id="other_food_type" name="other_food_type" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>

                            <div class="question">
                                <h4 class="question-title">Q3. If you were to try Thai food, which type of product or platform would you prefer to have Thai cuisine served on?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="platform_ready_to_cook" name="product_platform_preference[]" value="Ready-to-cook product">
                                        <label for="platform_ready_to_cook">Ready-to-cook product (e.g., from a store or online)</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="platform_ready_to_eat" name="product_platform_preference[]" value="Ready-to-eat product">
                                        <label for="platform_ready_to_eat">Ready-to-eat product (e.g., from a store or online)</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="platform_restaurant" name="product_platform_preference[]" value="Restaurant">
                                        <label for="platform_restaurant">Restaurant</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="platform_street_food" name="product_platform_preference[]" value="Street food">
                                        <label for="platform_street_food">Street food</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="platform_other" name="product_platform_preference[]" value="Other">
                                        <label for="platform_other">Other</label>
                                        <input type="text" id="other_platform_type" name="other_platform_type" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>

                            <!-- คำถามการให้คะแนน JadJaan sample -->
                            <div class="question-container">
                                <h4 class="question-title">Q4. Please rate the JadJaan sample on a scale of 1-5: (1 = Bad, 5 = Good)</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_rating_1" name="jadjaan_sample_rating" value="1">
                                    <label class="form-check-label" for="jadjaan_rating_1">1</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_rating_2" name="jadjaan_sample_rating" value="2">
                                    <label class="form-check-label" for="jadjaan_rating_2">2</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_rating_3" name="jadjaan_sample_rating" value="3">
                                    <label class="form-check-label" for="jadjaan_rating_3">3</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_rating_4" name="jadjaan_sample_rating" value="4">
                                    <label class="form-check-label" for="jadjaan_rating_4">4</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_rating_5" name="jadjaan_sample_rating" value="5">
                                    <label class="form-check-label" for="jadjaan_rating_5">5</label>
                                </div>
                            </div>

                            <!-- คำถามการลอง JadJaan sample -->
                            <div class="question-container">
                                <h4 class="question-title">Q5. Have you tried the JadJaan sample?</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_sample_tried_yes" name="jadjaan_sample_tried" value="Yes">
                                    <label class="form-check-label" for="jadjaan_sample_tried_yes">Yes</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jadjaan_sample_tried_no" name="jadjaan_sample_tried" value="No">
                                    <label class="form-check-label" for="jadjaan_sample_tried_no">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Thai Food - Eating Habits (for those who have tried Thai food) -->
                        <div class="section hidden" id="thaiEatingHabitsSection">
                            <h3>Section 2: Thai Food - Eating Habits</h3>

                            <div class="question-container">
                                <h4 class="question-title">6. How often do you eat Thai food?</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="frequency_weekly" name="thai_food_frequency" value="Once a week or more">
                                    <label class="form-check-label" for="frequency_weekly">Once a week or more</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="frequency_monthly" name="thai_food_frequency" value="Once a month">
                                    <label class="form-check-label" for="frequency_monthly">Once a month</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="frequency_less" name="thai_food_frequency" value="Less than once a month">
                                    <label class="form-check-label" for="frequency_less">Less than once a month</label>
                                </div>
                            </div>

                            <div class="question-container">
                                <h4 class="question-title">7. Where do you usually eat Thai food?</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="where_restaurants" name="where_eat" value="Restaurants">
                                    <label class="form-check-label" for="where_restaurants">Restaurants</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="where_home" name="where_eat" value="Home (Cook myself)">
                                    <label class="form-check-label" for="where_home">Home (Cook myself)</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="where_takeout" name="where_eat" value="Takeout/Delivery">
                                    <label class="form-check-label" for="where_takeout">Takeout/Delivery</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="where_other" name="where_eat" value="Others">
                                    <label class="form-check-label" for="where_other">Others</label>
                                    <input type="text" id="other_where_eat" name="other_where_eat" class="form-other-input" placeholder="Please specify">
                                </div>
                            </div>

                            <div class="question">
                                <h4 class="question-title">8. What challenges do you face when cooking Thai Ready-to-cook Product?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="challenge_ingredients" name="challenges[]" value="Difficulty finding ingredients">
                                        <label for="challenge_ingredients">Difficulty finding ingredients</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="challenge_recipes" name="challenges[]" value="Complicated recipes">
                                        <label for="challenge_recipes">Complicated recipes</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="challenge_time" name="challenges[]" value="Time-consuming preparation">
                                        <label for="challenge_time">Time-consuming preparation</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="challenge_flavor" name="challenges[]" value="Unable to cook as same flavours as Thai traditional taste">
                                        <label for="challenge_flavor">Unable to cook as same flavours as Thai traditional taste</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="challenge_other" name="challenges[]" value="Others">
                                        <label for="challenge_other">Others:</label>
                                        <input type="text" id="other_challenges" name="other_challenges" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>

                            <div class="question-container">
                                <h4 class="question-title">9. Have you ever bought Thai Ready-to-cook products before?</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="bought_before_yes" name="bought_before" value="Yes">
                                    <label class="form-check-label" for="bought_before_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="bought_before_no" name="bought_before" value="No">
                                    <label class="form-check-label" for="bought_before_no">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Preferences (Different sections based on previous answer) -->
                        <div class="section hidden" id="preferencesYesSection">
                            <h3>Section 3: Preferences for Thai Ready-to-Cook Products</h3>

                            <div class="question">
                                <h4 class="question-title">What is your purpose for buying Thai Ready-to-Cook products?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_personal" name="reason_for_buying[]" value="For personal consumption">
                                        <label for="reason_personal">For personal consumption</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_new_flavors" name="reason_for_buying[]" value="Try new and authentic flavors">
                                        <label for="reason_new_flavors">Try new and authentic flavors</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_convenience" name="reason_for_buying[]" value="For convenience and time-saving">
                                        <label for="reason_convenience">For convenience and time-saving</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="reason_gifting" name="reason_for_buying[]" value="For corporate gifting or special events">
                                        <label for="reason_gifting">For corporate gifting or special events</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="reason_buying_other" name="reason_for_buying[]" value="Others">
                                        <label for="reason_buying_other">Others</label>
                                        <input type="text" id="other_reason_buying" name="other_reason_buying" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section hidden" id="preferencesNoSection">
                            <h3>Section 3: Preferences for Thai Ready-to-Cook Products</h3>

                            <div class="question">
                                <h4 class="question-title">What are the reasons you have not purchased Thai Ready-to-Cook products?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="not_purchased_price" name="reason_not_purchased[]" value="Price too high">
                                        <label for="not_purchased_price">Price too high</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="not_purchased_quality" name="reason_not_purchased[]" value="Concern about quality">
                                        <label for="not_purchased_quality">Concern about quality</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="not_purchased_taste" name="reason_not_purchased[]" value="Concern about taste">
                                        <label for="not_purchased_taste">Concern about taste</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="not_purchased_ingredients" name="reason_not_purchased[]" value="Concern about unfamiliar ingredients">
                                        <label for="not_purchased_ingredients">Concern about unfamiliar ingredients</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="not_purchased_availability" name="reason_not_purchased[]" value="Limited availability in local stores">
                                        <label for="not_purchased_availability">Limited availability in local stores</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="not_purchased_other" name="reason_not_purchased[]" value="Others">
                                        <label for="not_purchased_other">Others</label>
                                        <input type="text" id="other_reason_not_purchased" name="other_reason_not_purchased" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>

                            <div class="question">
                                <h4 class="question-title">If you were to purchase a Thai Ready-to-Cook product, what appeals to you the most?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_convenience" name="appealing_factors[]" value="Convenience">
                                        <label for="appeal_convenience">Convenience</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_taste" name="appealing_factors[]" value="Authentic taste">
                                        <label for="appeal_taste">Authentic taste</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_health" name="appealing_factors[]" value="Healthy ingredients">
                                        <label for="appeal_health">Healthy ingredients</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_affordability" name="appealing_factors[]" value="Affordability">
                                        <label for="appeal_affordability">Affordability</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_instructions" name="appealing_factors[]" value="Easy instructions">
                                        <label for="appeal_instructions">Easy instructions</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_brand" name="appealing_factors[]" value="Brand reputation">
                                        <label for="appeal_brand">Brand reputation</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_sustainability" name="appealing_factors[]" value="Sustainability">
                                        <label for="appeal_sustainability">Sustainability</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="appeal_other" name="appealing_factors[]" value="Others">
                                        <label for="appeal_other">Others</label>
                                        <input type="text" id="other_appeal" name="other_appeal" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Common questions for all paths -->
                        <div class="section hidden" id="commonQuestionsSection">
                            <h3>Additional Questions</h3>

                            <div class="question">
                                <h4 class="question-title">10. What appeals to you most in Thai Ready-to-cook products?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_convenience2" name="appeal[]" value="Convenience">
                                        <label for="appeal_convenience2">Convenience</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_taste2" name="appeal[]" value="Authentic taste">
                                        <label for="appeal_taste2">Authentic taste</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_health2" name="appeal[]" value="Healthy ingredients">
                                        <label for="appeal_health2">Healthy ingredients</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_affordability2" name="appeal[]" value="Affordability">
                                        <label for="appeal_affordability2">Affordability</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_instructions2" name="appeal[]" value="Easy instructions">
                                        <label for="appeal_instructions2">Easy instructions</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_brand2" name="appeal[]" value="Brand reputation">
                                        <label for="appeal_brand2">Brand reputation</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="appeal_sustainability2" name="appeal[]" value="Sustainability">
                                        <label for="appeal_sustainability2">Sustainability</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="appeal_other2" name="appeal[]" value="Others">
                                        <label for="appeal_other2">Others:</label>
                                        <input type="text" id="other_appeal2" name="other_appeal2" placeholder="Please specify">
                                    </div>
                                </div>
                            </div>

                            <div class="question-container">
                                <h4 class="question-title">11. Would you consider buying a Thai Ready-to-cook Thai product if it were available in your area?</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="buy_ready_yes" name="buy_ready_to_cook" value="Yes">
                                    <label class="form-check-label" for="buy_ready_yes">Yes</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="buy_ready_no" name="buy_ready_to_cook" value="No">
                                    <label class="form-check-label" for="buy_ready_no">No</label>
                                </div>
                            </div>

                            <div class="question">
                                <h4 class="question-title">12. What types of Thai dishes would you like as ready-to-cook products?</h4>
                                <p>Please select up to 5 options</p>
                                <div class="checkbox-group">
                                    <!-- Soup -->
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_tom_kha" name="thai_dishes[]" value="Tom Kha" class="dish-checkbox">
                                        <label for="dish_tom_kha">1. Tom Kha</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_tom_yam" name="thai_dishes[]" value="Tom Yam" class="dish-checkbox">
                                        <label for="dish_tom_yam">2. Tom Yam</label>
                                    </div>

                                    <!-- Curry -->
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_panang" name="thai_dishes[]" value="Panaeng Curry" class="dish-checkbox">
                                        <label for="dish_panang">3. Panaeng Curry</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_massaman" name="thai_dishes[]" value="Massaman Curry" class="dish-checkbox">
                                        <label for="dish_massaman">4. Massaman Curry</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_green_curry" name="thai_dishes[]" value="Green Curry" class="dish-checkbox">
                                        <label for="dish_green_curry">5. Green Curry</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_red_curry" name="thai_dishes[]" value="Red Curry" class="dish-checkbox">
                                        <label for="dish_red_curry">6. Red Curry</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_khao_soi" name="thai_dishes[]" value="Khao Soi" class="dish-checkbox">
                                        <label for="dish_khao_soi">7. Khao Soi</label>
                                    </div>

                                    <!-- Stir-fry and Others -->
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_pad_thai" name="thai_dishes[]" value="Phod Thai" class="dish-checkbox">
                                        <label for="dish_pad_thai">8. Phod Thai</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_shrimp_paste" name="thai_dishes[]" value="Shrimp Paste" class="dish-checkbox">
                                        <label for="dish_shrimp_paste">9. Shrimp Paste</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="dish_krapao" name="thai_dishes[]" value="Stir-fry Holy Basil" class="dish-checkbox">
                                        <label for="dish_krapao">10. Stir-fry Holy Basil "Krapao"</label>
                                    </div>
                                    <div class="checkbox-others">
                                        <input type="checkbox" id="dish_other" name="thai_dishes[]" value="Others" class="dish-checkbox">
                                        <label for="dish_other">11. Others:</label>
                                        <input type="text" id="other_thai_dishes" name="other_thai_dishes" placeholder="Please specify">
                                    </div>
                                </div>
                                <div id="dishes-error-message" class="error-message hidden">You can only select up to 5 options.</div>
                            </div>
                        </div>

                        <!-- Section 4: Shopping Behavior -->
                        <div class="section hidden" id="shoppingBehaviorSection">
                            <h3>Section 4: Shopping Behavior</h3>

                            <div class="question-container">
                                <h4 class="question-title">13. Where do you usually purchase Thai Ready-to-cook products?</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purchase_supermarkets" name="purchase_location" value="Supermarkets">
                                    <label class="form-check-label" for="purchase_supermarkets">Supermarkets</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purchase_convenience" name="purchase_location" value="Convenience stores">
                                    <label class="form-check-label" for="purchase_convenience">Convenience stores (e.g., 7-11)</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purchase_online" name="purchase_location" value="Online stores">
                                    <label class="form-check-label" for="purchase_online">Online stores</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purchase_specialty" name="purchase_location" value="Specialty stores">
                                    <label class="form-check-label" for="purchase_specialty">Specialty stores (e.g., Thai grocery)</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purchase_other" name="purchase_location" value="Others">
                                    <label class="form-check-label" for="purchase_other">Others:</label>
                                    <input type="text" id="other_purchase_location" name="other_purchase_location" class="form-other-input" placeholder="Please specify">
                                </div>
                            </div>

                            <div class="question-container">
                                <h4 class="question-title">14. How much are you willing to spend on a ready-to-cook Thai product? (Package for 2 Servings)</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="spend_under_500" name="willing_to_spend" value="Under ¥500">
                                    <label class="form-check-label" for="spend_under_500">Under ¥500</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="spend_500_1000" name="willing_to_spend" value="¥500–¥1,000">
                                    <label class="form-check-label" for="spend_500_1000">¥500 - ¥1,000</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="spend_1000_1500" name="willing_to_spend" value="¥1,000–¥1,500">
                                    <label class="form-check-label" for="spend_1000_1500">¥1,000 - ¥1,500</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="spend_over_1500" name="willing_to_spend" value="Over ¥1,500">
                                    <label class="form-check-label" for="spend_over_1500">Over ¥1,500</label>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Jad Jaan Ready-to-Cook Products -->
                        <div class="section hidden" id="jadjaanProductsSection">
                            <h3>Section 5: Jad Jaan Ready-to-Cook Products</h3>

                            <div class="question">
                                <h4 class="question-title">15. Which Jad Jaan menu item have you tried?</h4>
                                <div class="checkbox-group">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_khao" name="menu_items[]" value="Khao">
                                        <label for="menu_khao">Khao</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_nam_prik_kapi" name="menu_items[]" value="Nam Prik Kapi">
                                        <label for="menu_nam_prik_kapi">Nam Prik Kapi</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_kanom_jeen" name="menu_items[]" value="Kanom Jeen">
                                        <label for="menu_kanom_jeen">Kanom Jeen</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_gaeng_pak_wan" name="menu_items[]" value="Gaeng Pak Wan">
                                        <label for="menu_gaeng_pak_wan">Gaeng Pak Wan</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_tom_yum" name="menu_items[]" value="Tom Yum">
                                        <label for="menu_tom_yum">Tom Yum</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_tom_kha" name="menu_items[]" value="Tom Kha">
                                        <label for="menu_tom_kha">Tom Kha</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_gaeng_nor_mai" name="menu_items[]" value="Gaeng Nor Mai">
                                        <label for="menu_gaeng_nor_mai">Gaeng Nor Mai</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_gaeng_khiew_wan" name="menu_items[]" value="Gaeng Khiew Wan">
                                        <label for="menu_gaeng_khiew_wan">Gaeng Khiew Wan</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_gaeng_khua_hoy" name="menu_items[]" value="Gaeng Khua Hoy">
                                        <label for="menu_gaeng_khua_hoy">Gaeng Khua Hoy</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_massaman" name="menu_items[]" value="Massaman">
                                        <label for="menu_massaman">Massaman</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="menu_panang" name="menu_items[]" value="Panang">
                                        <label for="menu_panang">Panang</label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-container">
                                <h4 class="question-title">16. How would you rate the taste of JadJaan Sampling on a scale of 1 to 5?</h4>

                                <div class="rating-container">
                                    <div class="range-labels">
                                        <span>1 - Not satisfied</span>
                                        <span>5 - Very satisfied</span>
                                    </div>

                                    <input type="range" id="taste_rating" name="taste_rating" min="1" max="5" value="3" class="custom-range" oninput="updateEmoji(this.value)">

                                    <div id="emoji_display" class="emoji-display">😐 3</div>

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
</section>
@endsection

@push('scripts')
<script>
    // ฟังก์ชันเปลี่ยน emoji ตามคะแนน
    function updateEmoji(value) {
        const emoji = document.getElementById('emoji_display');

        // เปลี่ยน emoji และข้อความตามคะแนน
        switch(parseInt(value)) {
            case 1:
                emoji.innerHTML = "😞 1 - Not satisfied";
                emoji.style.backgroundColor = "#ffcccb";
                break;
            case 2:
                emoji.innerHTML = "🙁 2 - Somewhat unsatisfied";
                emoji.style.backgroundColor = "#ffe4cc";
                break;
            case 3:
                emoji.innerHTML = "😐 3 - Neutral";
                emoji.style.backgroundColor = "#fff7cc";
                break;
            case 4:
                emoji.innerHTML = "🙂 4 - Satisfied";
                emoji.style.backgroundColor = "#e6ffcc";
                break;
            case 5:
                emoji.innerHTML = "😄 5 - Very satisfied";
                emoji.style.backgroundColor = "#ccffd8";
                break;
        }
    }

    // ตรวจสอบการเลือกเมนูไทยไม่เกิน 5 รายการ
    document.addEventListener('DOMContentLoaded', function() {
        // ตั้งค่า emoji เริ่มต้น
        updateEmoji(document.getElementById('taste_rating').value);

        // จำกัดการเลือกประเภทอาหารไทยไม่เกิน 5 รายการ
        const dishCheckboxes = document.querySelectorAll('.dish-checkbox');
        const errorMessage = document.getElementById('dishes-error-message');

        dishCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const checked = document.querySelectorAll('.dish-checkbox:checked');

                if (checked.length > 5) {
                    this.checked = false;
                    errorMessage.classList.remove('hidden');
                } else {
                    errorMessage.classList.add('hidden');
                }
            });
        });

        // การควบคุมการแสดงส่วนต่างๆ ตามคำตอบ
        const tasteThaiFood = document.querySelectorAll('input[name="taste_thai_food"]');
        const boughtBefore = document.querySelectorAll('input[name="bought_before"]');

        tasteThaiFood.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === 'Yes') {
                    document.getElementById('neverTriedSection').classList.add('hidden');
                    document.getElementById('thaiEatingHabitsSection').classList.remove('hidden');
                } else {
                    document.getElementById('thaiEatingHabitsSection').classList.add('hidden');
                    document.getElementById('neverTriedSection').classList.remove('hidden');
                }
            });
        });

        boughtBefore.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === 'Yes') {
                    document.getElementById('preferencesYesSection').classList.remove('hidden');
                    document.getElementById('preferencesNoSection').classList.add('hidden');
                } else {
                    document.getElementById('preferencesYesSection').classList.add('hidden');
                    document.getElementById('preferencesNoSection').classList.remove('hidden');
                }

                // แสดงส่วนคำถามทั่วไปและส่วนพฤติกรรมการซื้อ
                document.getElementById('commonQuestionsSection').classList.remove('hidden');
                document.getElementById('shoppingBehaviorSection').classList.remove('hidden');
                document.getElementById('jadjaanProductsSection').classList.remove('hidden');
            });
        });
    });
</script>
@endpush
