<?php

use Illuminate\Support\Facades\Route;
use App\{TheLoai, LoaiTin, Slide, Comment, User, TinTuc};
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    $theloai = User::find(1);
    echo $theloai . "<br>";
});

Route::get('admin/dangnhap', 'UserController@getdangnhapAdmin');
Route::post('admin/dangnhap', 'UserController@postdangnhapAdmin');
Route::get('admin/dangxuat', 'UserController@getdangxuatAdmin');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach', 'TheLoaiController@getDanhSach');
        Route::get('sua/{id}', 'TheLoaiController@getSua');
        Route::post('sua/{id}', 'TheLoaiController@postSua');
        Route::get('xoa/{id}', 'TheLoaiController@getXoa');
        Route::get('them', 'TheLoaiController@getThem');
        Route::post('them', 'TheLoaiController@postThem');
    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach', 'LoaiTinController@getDanhSach');
        Route::get('sua/{id}', 'LoaiTinController@getSua');
        Route::post('sua/{id}', 'LoaiTinController@postSua');
        Route::get('xoa/{id}', 'LoaiTinController@getXoa');
        Route::get('them', 'LoaiTinController@getThem');
        Route::post('them', 'LoaiTinController@postThem');
    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach', 'TinTucController@getDanhSach');
        Route::get('sua/{id}', 'TinTucController@getSua');
        Route::post('sua/{id}', 'TinTucController@postSua');
        Route::get('xoa/{id}', 'TinTucController@getXoa');
        Route::get('them', 'TinTucController@getThem');
        Route::post('them', 'TinTucController@postThem');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', 'UserController@getDanhSach');
        Route::get('sua/{id}', 'UserController@getSua');
        Route::post('sua/{id}', 'UserController@postSua');
        Route::get('xoa/{id}', 'UserController@getXoa');
        Route::get('them', 'UserController@getThem');
        Route::post('them', 'UserController@postThem');
    });
    Route::group(['prefix' => 'slide'], function () {
        Route::get('danhsach', 'SlideController@getDanhSach');
        Route::get('sua/{id}', 'SlideController@getSua');
        Route::post('sua/{id}', 'SlideController@postSua');
        Route::get('xoa/{id}', 'SlideController@getXoa');
        Route::get('them', 'SlideController@getThem');
        Route::post('them', 'SlideController@postThem');
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
    });
});
