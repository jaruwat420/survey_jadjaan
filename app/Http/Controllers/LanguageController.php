<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLang($lang)
    {
        session()->put('locale', $lang);
        return view('frontend.survey.index');
    }

    public function changeLangContact() {
        session()->put('locale', $lang);
        return view('frontend.contact.contact');
    }
}
