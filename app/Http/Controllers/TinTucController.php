<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        return view('admin.tintuc.danhsach');
    }
    public function getThem(){
        return view('admin.tintuc.them');
    }
    public function getSua(){
        return view('admin.tintuc.sua');
    }
}
