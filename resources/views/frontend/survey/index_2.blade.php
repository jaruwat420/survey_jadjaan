@extends('frontend.layouts.master')

@section('title', 'url')
@section('css')
<style>
    /* Custom Radio Button Styling */
    input[type="radio"] {
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
        vertical-align: middle;
        transition: all 0.3s ease;
    }

    input[type="radio"]:checked {
        border-color: #ff6b6b;
        background-color: #ffffff;
    }

    input[type="radio"]:checked:after {
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

    input[type="radio"]:hover {
        border-color: #ffd93d;
    }

    /* จัดรูปแบบของ label ที่อยู่ติดกับ radio */
    input[type="radio"] + label {
        display: inline-block;
        padding: 5px 10px;
        cursor: pointer;
        vertical-align: middle;
        transition: color 0.3s ease;
    }

    input[type="radio"]:checked + label {
        font-weight: 500;
        color: #ff6b6b;
    }

    /* จัดรูปแบบกลุ่มตัวเลือก */
    .radio-group {
        margin-bottom: 15px;
        padding: 10px 0;
        border-left: 3px solid #ffd93d;
        padding-left: 15px;
    }

    .option-row {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    /* จัดรูปแบบกล่องข้อความสำหรับกรณี "Others" */
    input[type="text"].other-specify {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px 12px;
        margin-left: 10px;
        transition: all 0.3s ease;
    }

    input[type="text"].other-specify:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.25);
        outline: none;
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

                            <div class="question">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="question">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>

                        <!-- Section 1: Demographics -->
                        <div class="section" id="demographicsSection">
                            <h3>Section 1: Demographics</h3>

                            <div class="question">
                                <label for="nation">1. Which nation do you belong to?</label>
                                <input type="text" id="nation" name="nation">
                            </div>

                            <div class="question">
                                <label>2. Age Group</label><br>
                                <input type="radio" id="under_20" name="age_group" value="Under 20">
                                <label for="under_20">Under 20</label><br>
                                <input type="radio" id="20_30" name="age_group" value="20-30">
                                <label for="20_30">20–30</label><br>
                                <input type="radio" id="31_40" name="age_group" value="31-40">
                                <label for="31_40">31–40</label><br>
                                <input type="radio" id="41_50" name="age_group" value="41-50">
                                <label for="41_50">41–50</label><br>
                                <input type="radio" id="over_50" name="age_group" value="Over 50">
                                <label for="over_50">Over 50</label>
                            </div>

                            <div class="question">
                                <label>3. Gender</label><br>
                                <input type="radio" id="male" name="gender" value="Male">
                                <label for="male">Male</label><br>
                                <input type="radio" id="female" name="gender" value="Female">
                                <label for="female">Female</label><br>
                                <input type="radio" id="prefer_not_to_say" name="gender" value="Prefer not to say">
                                <label for="prefer_not_to_say">Prefer not to say</label>
                            </div>

                            <div class="question">
                                <label>4. Household Type</label><br>
                                <input type="radio" id="single" name="household_type" value="Single">
                                <label for="single">Single</label><br>
                                <input type="radio" id="couple" name="household_type" value="Couple">
                                <label for="couple">Couple</label><br>
                                <input type="radio" id="family_with_children" name="household_type" value="Family with children">
                                <label for="family_with_children">Family with children</label><br>
                                <input type="radio" id="other_household_type" name="household_type" value="Others">
                                <label for="other_household_type">Others</label>
                                <input type="text" id="other_household" name="other_household" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>5. Have you ever tasted Thai food before?</label><br>
                                <input type="radio" id="taste_thai_food_yes" name="taste_thai_food" value="Yes">
                                <label for="taste_thai_food_yes">Yes</label><br>
                                <input type="radio" id="taste_thai_food_no" name="taste_thai_food" value="No">
                                <label for="taste_thai_food_no">No</label><br>
                            </div>
                        </div>

                        <!-- Section 2.1: Never Tried Thai Food -->
                        <div class="section hidden" id="neverTriedSection">
                            <h3>Section 2.1: Never Tried Thai Food</h3>

                            <div class="question">
                                <label>Q1. What is the reason you have never tried Thai food?</label><br>
                                <input type="checkbox" id="reason_not_familiar" name="reason_never_tried[]" value="Not familiar with Thai cuisine">
                                <label for="reason_not_familiar">Not familiar with Thai cuisine</label><br>
                                <input type="checkbox" id="reason_dont_like_spicy" name="reason_never_tried[]" value="Don't like spicy food">
                                <label for="reason_dont_like_spicy">Don't like spicy food</label><br>
                                <input type="checkbox" id="reason_concerned_ingredients" name="reason_never_tried[]" value="Concerned about ingredients">
                                <label for="reason_concerned_ingredients">Concerned about ingredients</label><br>
                                <input type="checkbox" id="reason_no_access" name="reason_never_tried[]" value="No access to Thai restaurants or products">
                                <label for="reason_no_access">No access to Thai restaurants or products</label><br>
                                <input type="checkbox" id="reason_price_high" name="reason_never_tried[]" value="Price is too high">
                                <label for="reason_price_high">Price is too high</label><br>
                                <input type="checkbox" id="reason_other" name="reason_never_tried[]" value="Other">
                                <label for="reason_other">Other</label>
                                <input type="text" id="other_reason" name="other_reason" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>Q2. If you were to try Thai food, what type of food would you like to try?</label><br>
                                <input type="checkbox" id="food_type_soup" name="food_type_to_try[]" value="Soup">
                                <label for="food_type_soup">Soup</label><br>
                                <input type="checkbox" id="food_type_noodles" name="food_type_to_try[]" value="Noodles">
                                <label for="food_type_noodles">Noodles</label><br>
                                <input type="checkbox" id="food_type_stir_fried" name="food_type_to_try[]" value="Stir-fried">
                                <label for="food_type_stir_fried">Stir-fried</label><br>
                                <input type="checkbox" id="food_type_curry" name="food_type_to_try[]" value="Curry">
                                <label for="food_type_curry">Curry</label><br>
                                <input type="checkbox" id="food_type_pasta" name="food_type_to_try[]" value="Pasta">
                                <label for="food_type_pasta">Pasta</label><br>
                                <input type="checkbox" id="food_type_deep_fried" name="food_type_to_try[]" value="Deep-fried">
                                <label for="food_type_deep_fried">Deep-fried</label><br>
                                <input type="checkbox" id="food_type_other" name="food_type_to_try[]" value="Other">
                                <label for="food_type_other">Other</label>
                                <input type="text" id="other_food_type" name="other_food_type" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>Q3. If you were to try Thai food, which type of product or platform would you prefer to have Thai cuisine served on?</label><br>
                                <input type="checkbox" id="platform_ready_to_cook" name="product_platform_preference[]" value="Ready-to-cook product">
                                <label for="platform_ready_to_cook">Ready-to-cook product (e.g., from a store or online)</label><br>
                                <input type="checkbox" id="platform_ready_to_eat" name="product_platform_preference[]" value="Ready-to-eat product">
                                <label for="platform_ready_to_eat">Ready-to-eat product (e.g., from a store or online)</label><br>
                                <input type="checkbox" id="platform_restaurant" name="product_platform_preference[]" value="Restaurant">
                                <label for="platform_restaurant">Restaurant</label><br>
                                <input type="checkbox" id="platform_street_food" name="product_platform_preference[]" value="Street food">
                                <label for="platform_street_food">Street food</label><br>
                                <input type="checkbox" id="platform_other" name="product_platform_preference[]" value="Other">
                                <label for="platform_other">Other</label>
                                <input type="text" id="other_platform_type" name="other_platform_type" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>Q4. Please rate the JadJaan sample on a scale of 1-5:(1 = Bad, 5 = Good)</label><br>
                                <input type="radio" id="jadjaan_rating_1" name="jadjaan_sample_rating" value="1">
                                <label for="jadjaan_rating_1">1</label><br>
                                <input type="radio" id="jadjaan_rating_2" name="jadjaan_sample_rating" value="2">
                                <label for="jadjaan_rating_2">2</label><br>
                                <input type="radio" id="jadjaan_rating_3" name="jadjaan_sample_rating" value="3">
                                <label for="jadjaan_rating_3">3</label><br>
                                <input type="radio" id="jadjaan_rating_4" name="jadjaan_sample_rating" value="4">
                                <label for="jadjaan_rating_4">4</label><br>
                                <input type="radio" id="jadjaan_rating_5" name="jadjaan_sample_rating" value="5">
                                <label for="jadjaan_rating_5">5</label><br>
                            </div>

                            <div class="question">
                                <label>Q5. Have you tried the JadJaan sample?</label><br>
                                <input type="radio" id="jadjaan_sample_tried_yes" name="jadjaan_sample_tried" value="Yes">
                                <label for="jadjaan_sample_tried_yes">Yes</label><br>
                                <input type="radio" id="jadjaan_sample_tried_no" name="jadjaan_sample_tried" value="No">
                                <label for="jadjaan_sample_tried_no">No</label><br>
                            </div>
                        </div>

                        <!-- Section 2: Thai Food - Eating Habits (for those who have tried Thai food) -->
                        <div class="section hidden" id="thaiEatingHabitsSection">
                            <h3>Section 2: Thai Food - Eating Habits</h3>

                            <div class="question">
                                <label>6. How often do you eat Thai food?</label><br>
                                <input type="radio" id="frequency_weekly" name="thai_food_frequency" value="Once a week or more">
                                <label for="frequency_weekly">Once a week or more</label><br>
                                <input type="radio" id="frequency_monthly" name="thai_food_frequency" value="Once a month">
                                <label for="frequency_monthly">Once a month</label><br>
                                <input type="radio" id="frequency_less" name="thai_food_frequency" value="Less than once a month">
                                <label for="frequency_less">Less than once a month</label><br>
                            </div>

                            <div class="question">
                                <label>7. Where do you usually eat Thai food?</label><br>
                                <input type="radio" id="where_restaurants" name="where_eat" value="Restaurants">
                                <label for="where_restaurants">Restaurants</label><br>
                                <input type="radio" id="where_home" name="where_eat" value="Home (Cook myself)">
                                <label for="where_home">Home (Cook myself)</label><br>
                                <input type="radio" id="where_takeout" name="where_eat" value="Takeout/Delivery">
                                <label for="where_takeout">Takeout/Delivery</label><br>
                                <input type="radio" id="where_other" name="where_eat" value="Others">
                                <label for="where_other">Others</label>
                                <input type="text" id="other_where_eat" name="other_where_eat" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>8. What challenges do you face when cooking Thai Ready-to-cook Product?</label><br>
                                <input type="checkbox" id="challenge_ingredients" name="challenges[]" value="Difficulty finding ingredients">
                                <label for="challenge_ingredients">Difficulty finding ingredients</label><br>
                                <input type="checkbox" id="challenge_recipes" name="challenges[]" value="Complicated recipes">
                                <label for="challenge_recipes">Complicated recipes</label><br>
                                <input type="checkbox" id="challenge_time" name="challenges[]" value="Time-consuming preparation">
                                <label for="challenge_time">Time-consuming preparation</label><br>
                                <input type="checkbox" id="challenge_flavor" name="challenges[]" value="Unable to cook as same flavours as Thai traditional taste">
                                <label for="challenge_flavor">Unable to cook as same flavours as Thai traditional taste</label><br>
                                <input type="checkbox" id="challenge_other" name="challenges[]" value="Others">
                                <label for="challenge_other">Others:</label>
                                <input type="text" id="other_challenges" name="other_challenges" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>9. Have you ever bought Thai Ready-to-cook products before?</label><br>
                                <input type="radio" id="bought_before_yes" name="bought_before" value="Yes">
                                <label for="bought_before_yes">Yes</label><br>
                                <input type="radio" id="bought_before_no" name="bought_before" value="No">
                                <label for="bought_before_no">No</label>
                            </div>
                        </div>

                        <!-- Section 3: Preferences (Different sections based on previous answer) -->
                        <div class="section hidden" id="preferencesYesSection">
                            <h3>Section 3: Preferences for Thai Ready-to-Cook Products</h3>

                            <div class="question">
                                <label>What is your purpose for buying Thai Ready-to-Cook products?</label><br>
                                <input type="checkbox" id="reason_personal" name="reason_for_buying[]" value="For personal consumption">
                                <label for="reason_personal">For personal consumption</label><br>
                                <input type="checkbox" id="reason_new_flavors" name="reason_for_buying[]" value="Try new and authentic flavors">
                                <label for="reason_new_flavors">Try new and authentic flavors</label><br>
                                <input type="checkbox" id="reason_convenience" name="reason_for_buying[]" value="For convenience and time-saving">
                                <label for="reason_convenience">For convenience and time-saving</label><br>
                                <input type="checkbox" id="reason_gifting" name="reason_for_buying[]" value="For corporate gifting or special events">
                                <label for="reason_gifting">For corporate gifting or special events</label><br>
                                <input type="checkbox" id="reason_buying_other" name="reason_for_buying[]" value="Others">
                                <label for="reason_buying_other">Others</label>
                                <input type="text" id="other_reason_buying" name="other_reason_buying" placeholder="Please specify" style="margin-left: 10px;">
                            </div>
                        </div>

                        <div class="section hidden" id="preferencesNoSection">
                            <h3>Section 3: Preferences for Thai Ready-to-Cook Products</h3>

                            <div class="question">
                                <label>What are the reasons you have not purchased Thai Ready-to-Cook products?</label><br>
                                <input type="checkbox" id="not_purchased_price" name="reason_not_purchased[]" value="Price too high">
                                <label for="not_purchased_price">Price too high</label><br>
                                <input type="checkbox" id="not_purchased_quality" name="reason_not_purchased[]" value="Concern about quality">
                                <label for="not_purchased_quality">Concern about quality</label><br>
                                <input type="checkbox" id="not_purchased_taste" name="reason_not_purchased[]" value="Concern about taste">
                                <label for="not_purchased_taste">Concern about taste</label><br>
                                <input type="checkbox" id="not_purchased_ingredients" name="reason_not_purchased[]" value="Concern about unfamiliar ingredients">
                                <label for="not_purchased_ingredients">Concern about unfamiliar ingredients</label><br>
                                <input type="checkbox" id="not_purchased_availability" name="reason_not_purchased[]" value="Limited availability in local stores">
                                <label for="not_purchased_availability">Limited availability in local stores</label><br>
                                <input type="checkbox" id="not_purchased_other" name="reason_not_purchased[]" value="Others">
                                <label for="not_purchased_other">Others</label>
                                <input type="text" id="other_reason_not_purchased" name="other_reason_not_purchased" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>If you were to purchase a Thai Ready-to-Cook product, what appeals to you the most?</label><br>
                                <input type="checkbox" id="appeal_convenience" name="appealing_factors[]" value="Convenience">
                                <label for="appeal_convenience">Convenience</label><br>
                                <input type="checkbox" id="appeal_taste" name="appealing_factors[]" value="Authentic taste">
                                <label for="appeal_taste">Authentic taste</label><br>
                                <input type="checkbox" id="appeal_health" name="appealing_factors[]" value="Healthy ingredients">
                                <label for="appeal_health">Healthy ingredients</label><br>
                                <input type="checkbox" id="appeal_affordability" name="appealing_factors[]" value="Affordability">
                                <label for="appeal_affordability">Affordability</label><br>
                                <input type="checkbox" id="appeal_instructions" name="appealing_factors[]" value="Easy instructions">
                                <label for="appeal_instructions">Easy instructions</label><br>
                                <input type="checkbox" id="appeal_brand" name="appealing_factors[]" value="Brand reputation">
                                <label for="appeal_brand">Brand reputation</label><br>
                                <input type="checkbox" id="appeal_sustainability" name="appealing_factors[]" value="Sustainability">
                                <label for="appeal_sustainability">Sustainability</label><br>
                                <input type="checkbox" id="appeal_other" name="appealing_factors[]" value="Others">
                                <label for="appeal_other">Others</label>
                                <input type="text" id="other_appeal" name="other_appeal" placeholder="Please specify" style="margin-left: 10px;">
                            </div>
                        </div>

                        <!-- Common questions for all paths -->
                        <div class="section hidden" id="commonQuestionsSection">
                            <h3>Additional Questions</h3>

                            <div class="question">
                                <label>10. What appeals to you most in Thai Ready-to-cook products?</label><br>
                                <input type="checkbox" id="appeal_convenience2" name="appeal[]" value="Convenience">
                                <label for="appeal_convenience2">Convenience</label><br>
                                <input type="checkbox" id="appeal_taste2" name="appeal[]" value="Authentic taste">
                                <label for="appeal_taste2">Authentic taste</label><br>
                                <input type="checkbox" id="appeal_health2" name="appeal[]" value="Healthy ingredients">
                                <label for="appeal_health2">Healthy ingredients</label><br>
                                <input type="checkbox" id="appeal_affordability2" name="appeal[]" value="Affordability">
                                <label for="appeal_affordability2">Affordability</label><br>
                                <input type="checkbox" id="appeal_instructions2" name="appeal[]" value="Easy instructions">
                                <label for="appeal_instructions2">Easy instructions</label><br>
                                <input type="checkbox" id="appeal_brand2" name="appeal[]" value="Brand reputation">
                                <label for="appeal_brand2">Brand reputation</label><br>
                                <input type="checkbox" id="appeal_sustainability2" name="appeal[]" value="Sustainability">
                                <label for="appeal_sustainability2">Sustainability</label><br>
                                <input type="checkbox" id="appeal_other2" name="appeal[]" value="Others">
                                <label for="appeal_other2">Others:</label>
                                <input type="text" id="other_appeal2" name="other_appeal2" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>11. Would you consider buying a Thai Ready-to-cook Thai product if it were available in your area?</label><br>
                                <input type="radio" id="buy_ready_yes" name="buy_ready_to_cook" value="Yes">
                                <label for="buy_ready_yes">Yes</label><br>
                                <input type="radio" id="buy_ready_no" name="buy_ready_to_cook" value="No">
                                <label for="buy_ready_no">No</label><br>
                            </div>

                            <div class="question">
                                <label>12. What types of Thai dishes would you like as ready-to-cook products?</label><br>
                                <p>Please select up to 5 options</p>
                                <div id="thai_dishes_container">
                                    <!-- Soup -->
                                    <input type="checkbox" id="dish_tom_kha" name="thai_dishes[]" value="Tom Kha" class="dish-checkbox">
                                    <label for="dish_tom_kha">1. Tom Kha</label><br>
                                    <input type="checkbox" id="dish_tom_yam" name="thai_dishes[]" value="Tom Yam" class="dish-checkbox">
                                    <label for="dish_tom_yam">2. Tom Yam</label><br>

                                    <!-- Curry -->
                                    <input type="checkbox" id="dish_panang" name="thai_dishes[]" value="Panaeng Curry" class="dish-checkbox">
                                    <label for="dish_panang">3. Panaeng Curry</label><br>
                                    <input type="checkbox" id="dish_massaman" name="thai_dishes[]" value="Massaman Curry" class="dish-checkbox">
                                    <label for="dish_massaman">4. Massaman Curry</label><br>
                                    <input type="checkbox" id="dish_green_curry" name="thai_dishes[]" value="Green Curry" class="dish-checkbox">
                                    <label for="dish_green_curry">5. Green Curry</label><br>
                                    <input type="checkbox" id="dish_red_curry" name="thai_dishes[]" value="Red Curry" class="dish-checkbox">
                                    <label for="dish_red_curry">6. Red Curry</label><br>
                                    <input type="checkbox" id="dish_khao_soi" name="thai_dishes[]" value="Khao Soi" class="dish-checkbox">
                                    <label for="dish_khao_soi">7. Khao Soi</label><br>

                                    <!-- Stir-fry and Others -->
                                    <input type="checkbox" id="dish_pad_thai" name="thai_dishes[]" value="Phod Thai" class="dish-checkbox">
                                    <label for="dish_pad_thai">8. Phod Thai</label><br>
                                    <input type="checkbox" id="dish_shrimp_paste" name="thai_dishes[]" value="Shrimp Paste" class="dish-checkbox">
                                    <label for="dish_shrimp_paste">9. Shrimp Paste</label><br>
                                    <input type="checkbox" id="dish_krapao" name="thai_dishes[]" value="Stir-fry Holy Basil" class="dish-checkbox">
                                    <label for="dish_krapao">10. Stir-fry Holy Basil "Krapao"</label><br>
                                    <input type="checkbox" id="dish_other" name="thai_dishes[]" value="Others" class="dish-checkbox">
                                    <label for="dish_other">11. Others:</label>
                                    <input type="text" id="other_thai_dishes" name="other_thai_dishes" placeholder="Please specify" style="margin-left: 10px;"><br>
                                </div>
                                <div id="dishes-error-message" class="error-message hidden">You can only select up to 5 options.</div>
                            </div>
                        </div>

                        <!-- Section 4: Shopping Behavior -->
                        <div class="section hidden" id="shoppingBehaviorSection">
                            <h3>Section 4: Shopping Behavior</h3>

                            <div class="question">
                                <label>13. Where do you usually purchase Thai Ready-to-cook products?</label><br>
                                <input type="radio" id="purchase_supermarkets" name="purchase_location" value="Supermarkets">
                                <label for="purchase_supermarkets">Supermarkets</label><br>
                                <input type="radio" id="purchase_convenience" name="purchase_location" value="Convenience stores">
                                <label for="purchase_convenience">Convenience stores (e.g., 7-11)</label><br>
                                <input type="radio" id="purchase_online" name="purchase_location" value="Online stores">
                                <label for="purchase_online">Online stores</label><br>
                                <input type="radio" id="purchase_specialty" name="purchase_location" value="Specialty stores">
                                <label for="purchase_specialty">Specialty stores (e.g., Thai grocery)</label><br>
                                <input type="radio" id="purchase_other" name="purchase_location" value="Others">
                                <label for="purchase_other">Others:</label>
                                <input type="text" id="other_purchase_location" name="other_purchase_location" placeholder="Please specify" style="margin-left: 10px;">
                            </div>

                            <div class="question">
                                <label>14. How much are you willing to spend on a ready-to-cook Thai product? (Package for 2 Servings)</label><br>
                                <input type="radio" id="spend_under_500" name="willing_to_spend" value="Under ¥500">
                                <label for="spend_under_500">Under ¥500</label><br>
                                <input type="radio" id="spend_500_1000" name="willing_to_spend" value="¥500–¥1,000">
                                <label for="spend_500_1000">¥500 - ¥1,000</label><br>
                                <input type="radio" id="spend_1000_1500" name="willing_to_spend" value="¥1,000–¥1,500">
                                <label for="spend_1000_1500">¥1,000 - ¥1,500</label><br>
                                <input type="radio" id="spend_over_1500" name="willing_to_spend" value="Over ¥1,500">
                                <label for="spend_over_1500">Over ¥1,500</label>
                            </div>
                        </div>

                        <!-- Section 5: Jad Jaan Ready-to-Cook Products -->
                        <div class="section hidden" id="jadjaanProductsSection">
                            <h3>Section 5: Jad Jaan Ready-to-Cook Products</h3>

                            <div class="question">
                                <label>15. Which Jad Jaan menu item have you tried?</label><br>
                                <input type="checkbox" id="menu_khao" name="menu_items[]" value="Khao">
                                <label for="menu_khao">Khao</label><br>
                                <input type="checkbox" id="menu_nam_prik_kapi" name="menu_items[]" value="Nam Prik Kapi">
                                <label for="menu_nam_prik_kapi">Nam Prik Kapi</label><br>
                                <input type="checkbox" id="menu_kanom_jeen" name="menu_items[]" value="Kanom Jeen">
                                <label for="menu_kanom_jeen">Kanom Jeen</label><br>
                                <input type="checkbox" id="menu_gaeng_pak_wan" name="menu_items[]" value="Gaeng Pak Wan">
                                <label for="menu_gaeng_pak_wan">Gaeng Pak Wan</label><br>
                                <input type="checkbox" id="menu_tom_yum" name="menu_items[]" value="Tom Yum">
                                <label for="menu_tom_yum">Tom Yum</label><br>
                                <input type="checkbox" id="menu_tom_kha" name="menu_items[]" value="Tom Kha">
                                <label for="menu_tom_kha">Tom Kha</label><br>
                                <input type="checkbox" id="menu_gaeng_nor_mai" name="menu_items[]" value="Gaeng Nor Mai">
                                <label for="menu_gaeng_nor_mai">Gaeng Nor Mai</label><br>
                                <input type="checkbox" id="menu_gaeng_khiew_wan" name="menu_items[]" value="Gaeng Khiew Wan">
                                <label for="menu_gaeng_khiew_wan">Gaeng Khiew Wan</label><br>
                                <input type="checkbox" id="menu_gaeng_khua_hoy" name="menu_items[]" value="Gaeng Khua Hoy">
                                <label for="menu_gaeng_khua_hoy">Gaeng Khua Hoy</label><br>
                                <input type="checkbox" id="menu_massaman" name="menu_items[]" value="Massaman">
                                <label for="menu_massaman">Massaman</label><br>
                                <input type="checkbox" id="menu_panang" name="menu_items[]" value="Panang">
                                <label for="menu_panang">Panang</label>
                            </div>
                            <div class="question">
                                <label for="taste_rating">16. How would you rate the taste of JadJaan Sampling on a scale of 1 to 5?</label><br>
                                <input type="range" id="taste_rating" name="taste_rating" min="1" max="5" value="3" style="width: 50%;" oninput="updateEmoji(this.value)">
                                <div id="emoji_display">😐 3</div>
                            </div>
                        </div>
                        <button type="submit" class="submit-button">Submit Survey</button>
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

        switch(parseInt(value)) {
            case 1:
                emoji.innerHTML = "😞 1 - Not satisfied";
                break;
            case 2:
                emoji.innerHTML = "🙁 2 - Somewhat unsatisfied";
                break;
            case 3:
                emoji.innerHTML = "😐 3 - Neutral";
                break;
            case 4:
                emoji.innerHTML = "🙂 4 - Satisfied";
                break;
            case 5:
                emoji.innerHTML = "😄 5 - Very satisfied";
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
