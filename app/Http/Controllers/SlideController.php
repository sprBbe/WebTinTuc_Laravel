<?php

namespace App\Http\Controllers;
use App\{TheLoai, LoaiTin, Slide, Comment, User, TinTuc};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SlideController extends Controller
{
    //
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach', ['slide' => $slide]);
    }
    public function getThem()
    {
        return view('admin.slide.them');
    }
    public function postThem(Request $request)
    {
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:2|max:100',
                'NoiDung' => 'required',
                'Hinh' => 'mimes:jpeg,jpg,png,raw',
                'Link' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên Slide!',
                'NoiDung.required' => 'Bạn chưa nhập nội dung Slide!',
                'Link.required' => 'Bạn chưa nhập link Slide!',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Hinh.mimes'=> 'Bạn không chọn đúng định dạng ảnh!',
            ]
        );
        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->link = $request->Link;
        $slide->NoiDung = $request->NoiDung;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("upload/slide/",$Hinh);
            $slide->Hinh = $Hinh; 
        }else{
            $slide->Hinh=""; 
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao', 'Thêm thành công!');
    }
    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.sua', ['slide' => $slide]);
    }
    public function postSua(Request $request, $id)
    {
        $slide =  Slide::find($id);
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:2|max:100',
                'NoiDung' => 'required',
                'Hinh' => 'mimes:jpeg,jpg,png,raw',
                'Link' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên Slide!',
                'NoiDung.required' => 'Bạn chưa nhập nội dung Slide!',
                'Link.required' => 'Bạn chưa nhập link Slide!',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Hinh.mimes'=> 'Bạn không chọn đúng định dạng ảnh!',
            ]
        );
        $slide->Ten = $request->Ten;
        $slide->link = $request->Link;
        $slide->NoiDung = $request->NoiDung;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("upload/slide/",$Hinh);
            unlink("upload/slide/".$slide->Hinh);
            $slide->Hinh = $Hinh; 
        }
        $slide->save();
        return redirect('admin/slide/sua/' . $id)->with('thongbao', 'Sửa thành công!');
    }
    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao', 'Xoá thành công!');
    }
}
