<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\{TheLoai, LoaiTin, Slide, Comment, User, TinTuc};
class PagesController extends Controller
{
    //
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
    }
    function trangchu(){
        return view('pages.trangchu');
    }
    function lienhe(){
        return view('pages.lienhe');
    }
    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin],['tintuc'=>$tintuc]);
    }
    function tintuc($id){
        $tintuc = TinTuc::find($id);
        //$tintuc->SoLuotXem=$tintuc->SoLuotXem+1; 
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]); 
    }
}
