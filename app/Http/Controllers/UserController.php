<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getDanhSach(){
        return view('admin.user.danhsach');
    }
    public function getThem(){
        return view('admin.user.them');
    }
    public function getSua(){
        return view('admin.user.sua');
    }
}
