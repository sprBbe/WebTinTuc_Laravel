<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
        return view('admin.slide.danhsach');
    }
    public function getThem(){
        return view('admin.slide.them');
    }
    public function getSua(){
        return view('admin.slide.sua');
    }
}
