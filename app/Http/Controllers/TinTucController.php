<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\{TheLoai, LoaiTin, Slide, Comment, User, TinTuc};
class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }
    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them', ['theloai' => $theloai], ['loaitin' => $loaitin]);
    }
    public function postThem(Request $request)
    {
        $this->validate(
            $request,
            [
                'TomTat' => 'required',
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:2|max:100',
                'LoaiTin' => 'required',
                'NoiDung' => 'required',
                'Hinh' => 'mimes:jpeg,jpg,png,raw',
            ],
            [
                'TomTat.required' => 'Bạn chưa nhập Tóm Tắt tin!',
                'TieuDe.required' => 'Bạn chưa nhập Tiêu Đề tin!',
                'TieuDe.unique' => 'Tiêu Đề tin đã tồn tại!',
                'TieuDe.min' => 'Tiêu Đề tin phải có độ dài từ 2 đến 100 ký tự!',
                'TieuDe.max' => 'Tiêu Đề tin phải có độ dài từ 2 đến 100 ký tự!',
                'LoaiTin.required' => 'Bạn chưa chọn Loại Tin!',
                'NoiDung.required' => 'Bạn chưa nhập Nội Dung tin!',
                'Hinh.mimes'=> 'Bạn không chọn đúng định dạng ảnh!'
            ]
        );
        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("upload/tintuc/",$Hinh);
            $tintuc->Hinh = $Hinh; 
        }else{
            $tintuc->Hinh=""; 
        }
        $tintuc->save();
        return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công!');
    }
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua', ['loaitin' => $loaitin], ['theloai' => $theloai]);
    }
    public function postSua(Request $request, $id)
    {
        $loaitin = LoaiTin::find($id);
        $this->validate(
            $request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:2|max:100',
                'TheLoai' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên loại tin!',
                'Ten.unique' => 'Tên loại tin đã tồn tại!',
                'Ten.min' => 'Tên loại tin phải có độ dài từ 2 đến 100 ký tự!',
                'Ten.max' => 'Tên loại tin phải có độ dài từ 2 đến 100 ký tự!',
                'Theloai.required' => 'Bạn chưa chọn thể loại!',
            ]
        );
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/' . $id)->with('thongbao', 'Sửa thành công!');
    }
    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xoá thành công!');
    }
}
