    
@extends('layout.index')
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">admin</a>
            </p>

            <!-- Date/Time -->
            <p style="text-align: right;"><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDe}}">

            <!-- Post Content -->
            <p class="lead">
                {!!$tintuc->NoiDung!!}
            </p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            @foreach ($tintuc->comment as $cm)
                <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$cm->user->name}}
                        <small>{{$cm->user->created_at}}</small>
                    </h4>
                    {{$cm->NoiDung}}
                </div>
            </div>
            @endforeach    
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    @foreach ($tinlienquan as $item)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$item['id']}}/{{$item['TieuDeKhongDau']}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="{{$item->TieuDe}}">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$item['id']}}/{{$item['TieuDeKhongDau']}}.html"><b>{{$item->TieuDe}}</b></a>
                            </div>
                            <p style="padding-left: 5px;">{{$item->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                    @foreach ($tinnoibat as $item)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$item['id']}}/{{$item['TieuDeKhongDau']}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="{{$item->TieuDe}}">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$item['id']}}/{{$item['TieuDeKhongDau']}}.html"><b>{{$item->TieuDe}}</b></a>
                            </div>
                            <p style="padding-left: 5px;">{{$item->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection