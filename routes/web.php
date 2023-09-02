<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VillaController;

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

Route::get('/', [UserController::class, 'index'])->name('home');

//membership user
Route::get('/membership', [UserController::class, 'membership_index'])->name('membership');
Route::get('/membership/post-registration', [UserController::class, 'post_reg_membership_index'])->name('post_reg_membership');
Route::get('/membership/verify/{token}', [UserController::class, 'verification'])->name('verification');
Route::get('/membership/post-verification', [UserController::class, 'post_ver_membership_index'])->name('post_ver_membership');
Route::get('/reload-captcha', [UserController::class, 'reloadCaptcha']);
Route::post('/store_member', [UserController::class, 'member_store'])->name('store_member');

//member login
Route::post('/member_postlogin', [LoginController::class, 'member_postlogin'])->name('member_postlogin');
Route::get('/member_logout', [LoginController::class, 'member_logout'])->name('member_logout');

//forgot password
Route::get('/membership/forget-password', [UserController::class, 'fp_index'])->name('forget_password');
Route::post('/membership/post-forget-password', [UserController::class, 'post_forget_password'])->name('post_forget_password');
Route::get('/membership/forget-password/verify/{token}', [UserController::class, 'forget_password_verification'])->name('forget_password_verification');
Route::patch('/membership/forget-password/edit-password/{password}/{token}', [UserController::class, 'update_password']);

//admin login
Route::get('/admin', [LoginController::class, 'login_index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//villa
Route::get('/villa-list', [UserController::class, 'villa_index'])->name('guest_villa');

route::group(['middleware' => ['auth','cekrole:superadmin, admin']], function() {
    
    //dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //jenis_membership
    Route::get('/jenis_membership', [MembershipController::class, 'jm_index'])->name('jenis_membership');
    Route::get('/create_membership', [MembershipController::class, 'jm_create'])->name('create_membership');
    Route::post('/store_membership', [MembershipController::class, 'jm_store'])->name('store_membership');
    Route::patch('/update_membership/{membership}', [MembershipController::class, 'jm_update']);
    Route::get('/delete_membership/{id}', [MembershipController::class, 'jm_destroy'])->name('delete_membership');
    Route::get('/jenis_membership/cari/', [MembershipController::class, 'jm_search'])->name('jm_search');

    //daftar_membership
    Route::get('/daftar_membership', [MembershipController::class, 'dm_index'])->name('daftar_membership');
    Route::get('/daftar_membership/cari/', [MembershipController::class, 'dm_search'])->name('dm_search');

    //penerimaan_membership
    Route::get('/penerimaan_membership', [MembershipController::class, 'pm_index'])->name('penerimaan_membership');
    Route::get('/penerimaan_membership/cari/', [MembershipController::class, 'pm_search'])->name('pm_search');
    Route::patch('/update_penerimaan_membership/{reg}', [MembershipController::class, 'pm_update']);    

    //daftar_member
    Route::get('/daftar_member', [MembershipController::class, 'dms_index'])->name('daftar_member');
    Route::get('/daftar_member/cari/', [MembershipController::class, 'dms_search'])->name('dms_search');

    //voucher
    Route::get('/list_voucher', [MembershipController::class, 'list_voucher_index'])->name('list_voucher');
    Route::get('/voucher_status_update/{v}', [MembershipController::class, 'voucher_status_update']);
    Route::get('/list_voucher/cari', [MembershipController::class, 'list_voucher_search'])->name('list_voucher_search');


    //slider
    Route::get('/slider', [HomeController::class, 'slider_index'])->name('slider');
    Route::get('/slider/cari', [HomeController::class, 'slider_search'])->name('slider_search');
    Route::get('/create_slider', [HomeController::class, 'slider_create'])->name('create_slider');
    Route::post('/store_slider', [HomeController::class, 'slider_store'])->name('store_slider');
    Route::get('/update_slider/{slider}', [HomeController::class, 'slider_update']);
    Route::patch('/update_slider_konten/{slider}', [HomeController::class, 'slider_konten_update']);
    Route::patch('/update_slider_picture/{slider}', [HomeController::class, 'slider_picture_update']);
    Route::get('/delete_slider/{id}', [HomeController::class, 'destroy_slider'])->name('delete_slider');

    //welcome
    Route::get('/welcome', [HomeController::class, 'welcome_index'])->name('welcome');
    Route::patch('/update_welcome_konten/{greeting}', [HomeController::class, 'welcome_konten_update']);
    Route::patch('/update_welcome_picture/{greeting}', [HomeController::class, 'welcome_picture_update']);
    Route::patch('/update_welcome_file/{greeting}', [HomeController::class, 'welcome_file_update']);

    //overview
    Route::get('/overview', [HomeController::class, 'overview_index'])->name('overview');
    Route::patch('/update_overview_konten/{overview}', [HomeController::class, 'overview_konten_update']);
    Route::patch('/update_overview_picture/{overview}', [HomeController::class, 'overview_picture_update']);

    //villa
    Route::get('/villa', [VillaController::class, 'villa_index'])->name('villa');
    Route::get('/villa/cari', [VillaController::class, 'villa_search'])->name('villa_search');
    Route::get('/create_villa', [VillaController::class, 'villa_create'])->name('create_villa');
    Route::post('/store_villa', [VillaController::class, 'villa_store'])->name('store_villa');
    Route::get('/villa/fitur/{villa}', [VillaController::class, 'fitur_index']);
    Route::post('/store_fitur/{villa}', [VillaController::class, 'fitur_store'])->name('store_fitur');
    Route::patch('/update_fitur/{feature}', [VillaController::class, 'fitur_update'])->name('update_fitur');
    Route::get('/delete_fitur/{id}', [VillaController::class, 'fitur_destroy'])->name('delete_fitur');
    Route::get('/villa/gallery/{villa}', [VillaController::class, 'gallery_index']);
    Route::post('/store_gallery/{villa}', [VillaController::class, 'gallery_store'])->name('store_gallery');
    Route::patch('/update_gallery/{gallery}', [VillaController::class, 'gallery_update'])->name('update_gallery');
    Route::get('/delete_gallery/{id}', [VillaController::class, 'gallery_destroy'])->name('delete_gallery');
    Route::get('/detail_villa/{villa}', [VillaController::class, 'villa_detail'])->name('detail_villa');
    Route::get('/edit_villa/{villa}', [VillaController::class, 'villa_edit'])->name('edit_villa');
    Route::patch('/update_villa_konten/{villa}', [VillaController::class, 'villa_konten_update'])->name('update_villa_konten');
    Route::patch('/update_villa_picture/{villa}', [VillaController::class, 'villa_picture_update'])->name('update_villa_picture');
    Route::patch('/update_villa_display/{villa}', [VillaController::class, 'villa_display_update'])->name('update_villa_display');
    Route::get('/delete_villa/{id}', [VillaController::class, 'villa_destroy'])->name('delete_villa');
});

route::group(['middleware' => ['auth','cekrole:member']], function() {
    
    //dashboard
    Route::get('/member/dashboard', [UserController::class, 'member_dashboard'])->name('member_dashboard');
    Route::patch('/member/edit-profile/{member}', [UserController::class, 'update_member']);
    Route::patch('/member/edit-password/{member}', [UserController::class, 'update_password_member']);
    Route::patch('/member/edit-pp/{member}', [UserController::class, 'update_pp_member']);

    //membership
    Route::get('/member/membership', [UserController::class, 'member_membership'])->name('member_membership');

    //voucher
    Route::get('/member/voucher', [UserController::class, 'member_voucher'])->name('member_voucher');
    Route::post('/member/store-voucher', [UserController::class, 'voucher_store'])->name('store_voucher');
    Route::get('/member/voucher/cari/', [UserController::class, 'voucher_search'])->name('voucher_search');
    Route::get('/member/voucher/e-voucher/{voucher}', [UserController::class, 'voucher_print']);
});


