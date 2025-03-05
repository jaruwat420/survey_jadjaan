<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLanguageSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าผู้ใช้ได้เลือกภาษาหรือยัง (เก็บใน session)
        if (!session()->has('locale')) {
            // ถ้ายังไม่ได้เลือกภาษา ให้เปลี่ยนเส้นทางไปยังหน้าเลือกภาษา
            return redirect()->route('language.select');
        }

        return $next($request);
    }
}
