@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                <small>Sửa "{{$tintuc->TieuDe}}"</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors)>0)
                     <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach       
                     </div>
                @endif
                @if (session('thongbao'))
                     <div class="alert alert-success">
                        {{session('thongbao')}} 
                     </div>
                @endif
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select id="TheLoai" class="form-control" name="TheLoai">
                            <option  disabled="disabled" selected="selected">Chọn Thể loại</option>
                            @foreach ($theloai as $tl)
                                <option 
                                @if ($tl->id == $tintuc->loaitin->idTheLoai)
                                    {{"selected"}}
                                @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>  
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select id="LoaiTin" class="form-control" name="LoaiTin">
                            @foreach ($loaitin as $lt)
                                <option 
                                @if ($lt->id == $tintuc->idLoaiTin)
                                    {{"selected"}}
                                @endif
                                value="{{$lt->id}}">{{$lt->Ten}}</option>  
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề tin tức" value="{{$tintuc->TieuDe}}"/>
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea name="TomTat" class="form-control" rows="3">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <p><img src="upload/tintuc/{{$tintuc->Hinh}}" width="200px"/></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tin Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" 
                            @if (0 == $tintuc->NoiBat)
                                    {{"checked"}}
                            @endif
                            type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" 
                            @if (1 == $tintuc->NoiBat)
                                    {{"checked"}}
                            @endif
                            value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa Tin Tức</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
                    <!-- /.container-fluid -->
        <!--Danh sách comment -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bình luận
                <small>Danh sách</small>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            @if (session('thongbaocomment'))
                <div class="alert alert-success">
                {{session('thongbaocomment')}} 
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người Dùng</th>
                        <th>Nội Dung</th>
                        <th>Ngày Đăng</th>
                        <th>Xoá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->user->name}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Xoá</a></td>
                        </tr>  
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

    
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#TheLoai").change(function(){
            var idTheLoai = $(this).val();
            $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                //alert(data);
                $("#LoaiTin").html(data);
            });
        });
    });
</script>
@endsection