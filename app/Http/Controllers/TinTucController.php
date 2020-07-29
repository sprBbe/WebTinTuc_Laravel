<?php

namespace App\Http\Controllers;

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
        return view('admin.tintuc.them', ['theloai' => $theloai]);
    }
    public function postThem(Request $request)
    {
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
        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
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
        $loaitin = TheLoai::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xoá thành công!');
    }
}
