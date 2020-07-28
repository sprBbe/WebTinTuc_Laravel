<?php

use Illuminate\Support\Facades\Route;
use App\{TheLoai,LoaiTin,Slide,Comment,User,TinTuc};
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
    $theloai=User::find(1);
    echo $theloai."<br>";
});

Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'theloai'],function(){
        Route::get('danhsach','TheLoaiController@getDanhSach');
        Route::get('sua','TheLoaiController@getSua');
        Route::get('them','TheLoaiController@getThem');
        Route::post('them','TheLoaiController@postThem');
    });
    Route::group(['prefix'=>'loaitin'],function(){
        Route::get('danhsach','LoaiTinController@getDanhSach');
        Route::get('sua','LoaiTinController@getSua');
        Route::get('them','LoaiTinController@getThem');
    });
    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('danhsach','TinTucController@getDanhSach');
        Route::get('sua','TinTucController@getSua');
        Route::get('them','TinTucController@getThem');
    });
    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','UserController@getDanhSach');
        Route::get('sua','UserController@getSua');
        Route::get('them','UserController@getThem');
    });
    Route::group(['prefix'=>'slide'],function(){
        Route::get('danhsach','SlideController@getDanhSach');
        Route::get('sua','SlideController@getSua');
        Route::get('them','SlideController@getThem');
    });
});