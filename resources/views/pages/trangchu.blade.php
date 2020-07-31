@extends('layout.index')
@section('content')

<!-- Page Content -->
<div class="container">

    @include('layout.slide')

    <div class="space20"></div>


    @include('layout.menu')

    <div class="col-md-9">
        <div class="panel panel-default">            
            <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                <h2 style="margin-top:0px; margin-bottom:0px;">Spring B'be Tin Tức</h2>
            </div>

            <div class="panel-body">
                @foreach ($theloai as $tl)
                    @if(count($tl->loaitin)>0)
                        <!-- item -->
                        <div class="row-item row">
                            <h3>
                                <a href="category.html">{{$tl->Ten}}</a> | 	
                                @foreach ($tl->loaitin as $lt)
                                    <small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
                                @endforeach
                            </h3>
                            <?php
                            $data=$tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
                            $tin1=$data->shift();
                            ?>
                            <div class="col-md-8 border-right">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-7">
                                    <h3>{{$tin1['TieuDe']}}</h3>
                                    <p>{{$tin1['TomTat']}}</p>
                                    <a class="btn btn-primary" href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Xem thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>
                            

                            <div class="col-md-4">
                                @foreach ($data->all() as $tintuc)
                                    <a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
                                        <h4>
                                            <span class="glyphicon glyphicon-list-alt"></span>
                                            {{$tintuc['TieuDe']}}
                                        </h4>
                                    </a>
                                @endforeach
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->   

@endsection