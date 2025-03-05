<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ReportController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\LeadDropController;
use App\Http\Controllers\LanguageSelectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** admin auth routes */
Route::group(['middleware' => 'guest'], function(){
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forget-password', [AdminAuthController::class, 'forgetPassword'])->name('admin.forget-password');
});

/** profile routes */
Route::group(['middleware' => 'auth', 'as' => 'profile.'], function(){
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile',[ProfileController::class, 'updateProfile'])->name('update');
    Route::put('profile/password',[ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('profile/avatar',[ProfileController::class, 'updateAvatar'])->name('avatar.update');
});

/** frontend routes*/
Route::get('url', [FrontendController::class, 'getUrl'])->name('url');
Route::post('url/copy', [FrontendController::class, 'copyUrl'])->name('create.history.url');
Route::post('url/open', [FrontendController::class, 'OpenUrl'])->name('open.history.url');

/** report routes */
Route::resource('report', ReportController::class)->middleware(['middleware' => 'auth']);
Route::get('sales_performance', [ReportController::class, 'salesPerformance'])->middleware(['middleware' => 'auth'])->name('sales.performance');
Route::get('sales/promotion', [ReportController::class, 'salesPromotion'])->middleware(['middleware' => 'auth'])->name('sales.promotion');
Route::get('sales/report/franchise', [ReportController::class, 'reportFranchise'])->middleware(['middleware' => 'auth'])->name('sales.report.franchise');

// หน้าเลือกภาษา
Route::get('/language/select', [LanguageSelectionController::class, 'select'])->name('language.select');
Route::post('/language/store', [LanguageSelectionController::class, 'store'])->name('language.store');

// เปลี่ยนภาษา
Route::get('/change/{lang}', [LanguageController::class, 'changeLang'])->name('changeLang');

// กลุ่มเส้นทางที่ต้องเลือกภาษาก่อน
Route::middleware('language.selected')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::resource('/survey', SurveyController::class);
    Route::resource('/contact', LeadDropController::class);
});

require __DIR__.'/auth.php';
