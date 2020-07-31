@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Người dùng
                    <small>Edit "{{$user->name}}"</small>
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
                <form action="admin/user/sua/{{$user->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Tên Người Dùng</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên người dùng" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="Email" placeholder="Nhập email người dùng" value="{{$user->email}}" readonly/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id ="changepassword" name="changepassword">
                        <label>Mật Khẩu</label>
                        <input type="password" class="form-control password" name="Password" placeholder="Nhập mật khẩu người dùng" disabled/>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại Mật Khẩu</label>
                        <input type="password" class="form-control password" name="PasswordAgain" placeholder="Nhập lại mật khẩu người dùng" disabled/>
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <label class="radio-inline">
                            <input name="Quyen" 
                            @if (0 == $user->quyen)
                                    {{"checked"}}
                            @endif
                            value="0" type="radio">Thường
                        </label>
                        <label class="radio-inline">
                            <input name="Quyen"
                            @if (1 == $user->quyen)
                                    {{"checked"}}
                            @endif
                            value="1" type="radio">Quản Trị
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa Người Dùng</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
    
@endsection
@section('script')
    <script>
       $(document).ready(function(){
            $("#changepassword").change(function(){
                if ($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                    //alert("checked");
                }else{
                    $(".password").attr('disabled','');
                    //alert("notchecked"); 
                }
            });
       });
    </script>
@endsection