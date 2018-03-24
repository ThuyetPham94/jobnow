@extends('company.main')


@section('content')
	<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span class="bg">Xem liên hệ</span>
                        <a href="" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="view-contact">
                            <div class="container-fuild">
                                <div class="border">
                                    <div class="top-content">
                                        {!! $data->FullName !!}
                                    </div>
                                    <div class="main-content">
                                        <div class="col-sm-12">
                                            <div class="top-view">
                                                <div class="avata col-sm-2">
                                                    @if(!empty($data->fb_id))
                                                        <img   src="{!! $data->Avatar !!}" class="img-circle img-responsive">
                                                    @else
                                                        @if($data->Avatar)
                                                            <img src="{!! Asset(url().'/'.Config('images.avatar_url').$data->Avatar) !!}" class="img-circle img-responsive">
                                                        @else
                                                            <img class="img-circle img-responsive"    src="{{ Asset('frontend/images/user-icon-20702.png') }}">
                                                        @endif
                                                    @endif
                                                    <p>
                                                        <span class="glyphicon glyphicon-envelope"></span>
                                                        <span class="glyphicon glyphicon-earphone"></span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-10 profile">
                                                    {{-- <p class="name">{!! $data->FullName !!}</p> --}}
                                                    <p class="des">{!! $data->Description !!}</p>
                                                    <p class="location">
                                                        {{-- <span class="first"><i class="glyphicon glyphicon-map-marker"></i>{!! $data->country->Name !!}</span> --}}
                                                        <span><i class="glyphicon glyphicon-briefcase"></i>Kinh nghiệm: </span>
                                                        <span><i class="glyphicon glyphicon-time"></i>Đã cập nhật: {!! $data->updated_at !!}</span>
                                                    </p>
                                                    <div class="tags">
                                                        <ul class="list-tags">
                                                        <!-- @if(!empty($data->Experience))
                                                        @foreach ($data->Experience as $val)
                                                            <li class="tag">{!! $val->Name !!}</li>
                                                        @endforeach
                                                        @endif -->
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="content-contact">
                                                <div class="col-sm-12">
                                                    <div class="about">
                                                        <span>Giới thiệu</span>
                                                        <p></p>
                                                    </div>
                                                    <div class="des">
                                                        <p></p>
                                                    </div>
                                                    <div class="detail">
                                                        {!! $data->Description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop