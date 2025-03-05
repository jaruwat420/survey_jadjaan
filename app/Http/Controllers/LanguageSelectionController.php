<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageSelectionController extends Controller
{
    public function select()
    {
        return view('lang.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'locale' => 'required|in:th,en,ja' // เพิ่มภาษาที่รองรับ
        ]);

        // เก็บค่าภาษาที่เลือกใน session
        session()->put('locale', $validated['locale']);
        app()->setLocale($validated['locale']);

        // ส่งกลับไปยังหน้าที่มาก่อนหน้า หรือไปยังหน้าหลัก
        return redirect()->intended('/');
    }
}
