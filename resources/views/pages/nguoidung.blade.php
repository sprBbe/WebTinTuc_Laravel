@extends('layout.index')
@section('content')    
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
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
				    	<form action="nguoidung" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" value="{{Auth::user()->name}}" class="form-control" placeholder="Username" name="Ten" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email" name="Email" aria-describedby="basic-addon1"
							  	disabled
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" class="" name="changepassword" id ="changepassword">
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" class="form-control password" name="Password" aria-describedby="basic-addon1" disabled>
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control password" name="PasswordAgain" aria-describedby="basic-addon1" disabled>
							</div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->

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