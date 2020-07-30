<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\{TheLoai, LoaiTin, Slide, Comment, User, TinTuc};
class CommentController extends Controller
{
    // Xoá Comment
    public function getXoa($id,$idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbaocomment', 'Xoá comment thành công!');
    }
}
