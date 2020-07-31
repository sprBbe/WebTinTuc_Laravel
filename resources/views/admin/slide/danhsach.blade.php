@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                @if (session('thongbao'))
                    <div class="alert alert-success">
                    {{session('thongbao')}} 
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Nội Dung</th>
                        <th>Hình</th>
                        <th>Link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($slide as $sd)
                        <tr class="odd gradeX" align="center">
                            <td>{{$sd->id}}</td>
                            <td>{{$sd->Ten}}</td>
                            <td>{{$sd->NoiDung}}</td>
                            <td>
                                <img src="upload/slide/{{$sd->Hinh}}" width='200px'>
                            </td>
                            <td>{{$sd->link}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$sd->id}}">Xoá</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sd->id}}">Sửa</a></td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>   
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
    
@endsection