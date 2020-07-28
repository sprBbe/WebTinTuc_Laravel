<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
        return view('admin.loaitin.danhsach');
    }
    public function getThem(){
        return view('admin.loaitin.them');
    }
    public function getSua(){
        return view('admin.loaitin.sua');
    }
}
