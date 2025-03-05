<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\AgeGroup;
use App\Models\Gender;
use App\Models\HouseHoldType;
use App\Models\ThaiFood;
use App\Models\EatThaiFood;
use App\Models\challenges;
use App\Models\Article13;
use App\Models\Article17;
use App\Models\Article18;
use App\Models\Article19;
use App\Models\Article21;
use App\Models\Article22;
use App\Models\Article23;



class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $path = $request->path();
        if ($path == 'contact') {
            return view ('lang.index', compact('path'));
        }else {
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        //return view ('frontend.survey.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        // Country
        $country = Country::all();

        // Age Group
        $ageGroup = AgeGroup::all();

        // Gender
        $Gender = Gender::all();

        // HouseHoldType
        $HouseHoldType = HouseHoldType::all();

        // HouseHoldType คำถามข้อ
        $ThaiFoods = ThaiFood::all();

        //  eatthaifood
        $EatThaiFood = EatThaiFood::all();

        // challenges
        $challenges = challenges::all();

        // Article13
        $Article13 = Article13::all();

        // Article17
        $Article17 = Article17::all();

        // Article18
        $Article18 = Article18::all();

        // Article19
        $Article19 = Article19::all();

        // Article21
        $Article21 = Article21::all();

        // Article22
        $Article22 = Article22::all();

        // Article23
        $Article23 = Article23::all();

        return view ('frontend.survey.index', compact(
            'country',
            'ageGroup',
            'Gender',
            'HouseHoldType',
            'ThaiFoods',
            'EatThaiFood',
            'challenges',
            'Article13',
            'Article17',
            'Article18',
            'Article19',
            'Article21',
            'Article22',
            'Article23',
            ));
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
