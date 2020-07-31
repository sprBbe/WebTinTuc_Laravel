@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Sửa {{$slide->Ten}}</small>
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
                <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên cho Slide" value="{{$slide->Ten}}"/>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea name="NoiDung" class="form-control" rows="3">{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <p><img src="upload/slide/{{$slide->Hinh}}" width="200px"/></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" placeholder="Nhập link cho Slide" value="{{$slide->link}}"/>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa Slide</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
    
@endsection