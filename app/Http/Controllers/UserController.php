<?php

namespace App\Http\Controllers;

use App\{TheLoai, LoaiTin, Slide, Comment, User, TinTuc};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach', ['user' => $user]);
    }
    public function getThem(){
        return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:2|max:100',
                'Email' => 'required|unique:users,email',
                'Password'=>'required|min:6|max:30',
                'PasswordAgain'=>'required|same:Password',
                'Quyen'=> 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên người dùng!',
                'Email.required' => 'Bạn chưa nhập email người dùng!',
                'Email.unique' => 'Email người dùng đã tồn tại!',
                'Quyen.required' => 'Bạn chưa chọn quyền người dùng!',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Password.required' => 'Bạn chưa nhập mật khẩu!',
                'Password.min' => 'Mật khẩu phải có độ dài từ 6 đến 30 ký tự!',
                'Password.max' => 'Mật khẩu phải có độ dài từ 6 đến 30 ký tự!',
                'PasswordAgain.required' => 'Bạn chưa nhập lại mật khẩu!',
                'PasswordAgain.same' => 'Mật khẩu nhập lại không khớp!',
            ]
        );
        $user = new User();
        $user->name = $request->Ten;
        $user->email = $request->Email;
        $user->password = bcrypt($request->Password);
        $user->quyen = $request->Quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao', 'Thêm thành công!');
    }
    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user' => $user]);
    }
    public function postSua(Request $request, $id)
    {   
        $user = User::find($id);
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:2|max:100',
                'Quyen'=> 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên người dùng!',
                'Quyen.required' => 'Bạn chưa chọn quyền người dùng!',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
            ]
        );
        $user->name = $request->Ten;
        $user->quyen = $request->Quyen;
        if($request->changepassword == "on"){
            $this->validate(
                $request,
                [
                    'Password'=>'required|min:6|max:30',
                    'PasswordAgain'=>'required|same:Password',
                ],
                [
                    'Password.required' => 'Bạn chưa nhập mật khẩu!',
                    'Password.min' => 'Mật khẩu phải có độ dài từ 6 đến 30 ký tự!',
                    'Password.max' => 'Mật khẩu phải có độ dài từ 6 đến 30 ký tự!',
                    'PasswordAgain.required' => 'Bạn chưa nhập lại mật khẩu!',
                    'PasswordAgain.same' => 'Mật khẩu nhập lại không khớp!',
                ]
            );
            $user->password = bcrypt($request->Password);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao', 'Sửa thành công!');
    }
    public function getXoa($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao', 'Xoá thành công!');
    }
    public function getdangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'Email' => 'required',
                'Password'=>'required|min:6|max:30',
            ],
            [
                'Email.required' => 'Bạn chưa nhập email người dùng!',
                'Password.required' => 'Bạn chưa nhập mật khẩu!',
                'Password.min' => 'Mật khẩu phải có độ dài từ 6 đến 30 ký tự!',
                'Password.max' => 'Mật khẩu phải có độ dài từ 6 đến 30 ký tự!',
            ]
        );
        
        if(Auth::attempt(['email' => $request->Email, 'password' => $request->Password])){
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect('admin/dangnhap')->with('canhbao', 'Đăng nhập không thành công!');
        }
    }
    public function getdangxuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
