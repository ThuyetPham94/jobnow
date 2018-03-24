@extends('company.main')


@section('content')
<script>
function goBack() {
    window.history.back();
}
</script>
	<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span class="bga"><p><img src="http://jobnew.vnblues.net/frontend/jobnow_backend/images/icon/view-c.png" style="margin-right: 20px;margin-left: 5px;cursor: pointer" onclick="goBack()">Xem liên hệ</p></span>
                        <a href="" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="view-contact">
                            <div class="container-fuild">
                                <div class="border">
                                    <div class="main-content">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Ảnh</th>
                                                <th>Tên</th>
                                                <th>Giới tính</th>
                                                <th>Tuổi</th>
                                                <th>Kinh nghiệm</th>
                                                <th>Ngày đăng</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                    <tbody>                                        
                                    @foreach ($res as $item)
                                        <tr>
                                            <td>{!! $item->id !!}</td>
                                            <td width="10%">                                               
                                                @if(!empty( $item->users->jobSeeker->fb_id))
                                                        <img   src="{!! $item->users->jobSeeker->Avatar !!}" class="img-circle img-responsive">
                                                    @else
                                                        @if( $item->users->jobSeeker->Avatar)
                                                            @if(substr(trim($item->users->jobSeeker->Avatar), 0,4) === 'http')
                                                                <img src="{!! $item->users->jobSeeker->Avatar !!}" class="img-circle img-responsive">
                                                            @else
                                                                <img src="{!! url().'/'.Config('images.avatar_url').$item->users->jobSeeker->Avatar !!}" class="img-circle img-responsive">
                                                            @endif
                                                        @else
                                                            <img class="img-circle img-responsive" width="40px"   src="{{ Asset('frontend/images/user-icon-20702.png') }}">
                                                        @endif
                                                    @endif
                                            </td>
                                            <td>{!! $item->users->jobSeeker->FullName !!}</td>
                                            <td><?php 
                                                if($item->users->jobSeeker->Gender==1){
                                                    echo "Nam";
                                                }else if($item->users->jobSeeker->Gender==2){
                                                    echo "Nữ";
                                                }else if($item->users->jobSeeker->Gender==3){
                                                    echo "Gay";
                                                }else{
                                                    echo "Les";
                                                }
                                             ?></td>
                                             <td><?php
                                             $today = date('Y');
                                             $birthday = date('Y',strtotime($item->users->jobSeeker->BirthDay));
                                             echo $today-$birthday;
                                             ?></td>
                                             <td>21</td>
                                             <td>{!! $item->created_at !!}</td>
                                             <td align="center"><a href="{!!  route('public.company.viewContact', ['id' => $item->users->jobSeeker->id]) !!}"><img src="{!! Asset('frontend/images/viewcontact.png') !!}" class="img-responsive"></a></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                    </div>
                                    <style type="text/css">
                                        td {
                                            vertical-align: middle !important;
                                        }
                                    </style>
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