<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    function gioithieu(){
        return view('pages.gioithieu');
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
    function getdangnhap(){
        return view('pages.dangnhap');
    }
    function getdangky(){
        return view('pages.dangky');
    }
    function postdangnhap(Request $request){
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
            return redirect('trangchu');
        }
        else{
            return redirect('dangnhap')->with('canhbao', 'Đăng nhập không thành công!');
        }
    }
    function postdangky(Request $request){
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:2|max:100',
                'Password'=>'required|min:6|max:30',
                'PasswordAgain'=>'required|same:Password',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên người dùng!',
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
        $user->save();
        return redirect('dangky')->with('thongbao', 'Đăng ký thành công!');
    }
    public function getdangxuat()
    {
        Auth::logout();
        return redirect('trangchu');
    }
    function postbinhluan(Request $request, $id){
        $comment = new Comment();
        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->Binhluan;
        $comment->save();
        return redirect('tintuc/'.$id.'/'.$comment->tintuc->TieuDeKhongDau.'.html')->with('thongbao', 'Thêm bình luận thành công!');
    }
    function getnguoidung(){
        return view('pages.nguoidung');
    }
    function postnguoidung(Request $request){
        $user = User::find(Auth::user()->id);
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:2|max:100',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên người dùng!',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 2 đến 100 ký tự!',
            ]
        );
        $user->name = $request->Ten;
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
        return redirect('nguoidung')->with('thongbao', 'Sửa thông tin thành công!');
    }
    function getTimKiem(Request $request){
        //$tukhoa = $request->Timkiem;
        $tukhoa=$request->get('Timkiem');
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->
        orwhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
