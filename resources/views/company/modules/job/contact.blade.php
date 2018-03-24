@extends('company.main')
@section('initMap')
@stop
@section('extra-lib')
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
        $('.setInterview').on('click', function () {
            $('body').scrollTop(100);
            $('#interview').show();
        });
        // $('#interview2').on('click', function () {
        //     alert('abc');
        //     $(this).hide();
        // });
        
        function hide() {
            //$('.glyphicon-remove').on('click', function () {
                $('#interview').hide();
                $('.form-control').val('');
           // })
        }
        function hide2() {
            // $('.glyphicon-remove').on('click', function () {
               $('#interview2').hide();
               
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("PHONE", function(value, element) {
                return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
            }, "Phone Number failse.");
            $('#form-interview').validate({
                rules : {
                    InterviewDate : 'required',
                    ContactName : 'required',
                    PhoneNumber : 'required PHONE',
                    Location : 'required',
                    Subjects : 'required',
                    Content : 'required'
                }
            });
        });
    </script>
    <style type="text/css">
        .error {
            color :red;
        }
        #download {
            background: #d8232a;
            color: #fff;
            display: inline-block;
            text-decoration: none;
            line-height: 40px;
            position: relative;
            padding-left: 50px;
            padding-right: 10px;
            margin-top: 10px;
        }
        #download i{
            padding: 13px;
            /* margin-top: -2px; */
            background: #a40303;
            position: absolute;
            top: 0;
            left: 0;
        }
        .list-ex li{
            background: url('uploads/images/ex_check.png') no-repeat;
        }
    </style>
    
    <div id="interview">
        <div class="setinter">
            <form action="{!! route('public.company.setInterview') !!}" method="POST" id="form-interview">
                <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                <input type="hidden" value="{!! request()->id !!}" name="JobSeekerID">
                <div class="head">Đặt thời gian phỏng vấn <span onclick="hide()" class="close glyphicon glyphicon-remove"></span></div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Ngày giờ <span>*</span></label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="InterviewDate" class="form-control" />
                            <span class="input-group-addon">
                                <b class="glyphicon glyphicon-calendar"></b>
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Phỏng vấn <span>*</span></label>
                        <input class="form-control" name="ContactName">
                    </div>
                    <div class="col-sm-6">
                        <label>Số điện thoại <span>*</span></label>
                        <input class="form-control" name="PhoneNumber">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Địa chỉ <span>*</span></label>
                        <input class="form-control" name="Location">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="Subjects">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Hồ sơ công ty <span>*</span></label>
                        <textarea class="form-control" name="Content" rows="8" style="resize: none;"></textarea>
                        <p class="text-right">(Chứa tối đa 14500 ký tự)</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="text-right">
                    <input type="reset" class="reset btn" value="Làm mới">
                    <input type="submit" class="send btn" value="Gửi">
                </div>
            </form>
        </div>
    </div>
    @if(session()->has('sended'))
        <div id="interview2" onclick="hide2()">
            <div class="mess">
                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                <strong>SENT</strong>
                <p>Congatulations you have successful set interview time forcandidate: <span>Nguyễn Trọng Hiếu</span></p>
            </div>
        </div>
    @endif
@stop
@section('content')
	<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span class="bga"><p><img src="http://jobnew.vnblues.net/frontend/jobnow_backend/images/icon/view-c.png" style="margin-right: 20px;margin-left: 5px;cursor: pointer" onclick="goBack()">View Contact</p></span>
                        <a href="" class="btn pull-right">Post A Job</a>
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
                                                            @if(substr(trim($data->Avatar), 0,4) === 'http')
                                                                    <img src="{!! $data->Avatar !!}" class="img-circle img-responsive">
                                                            @else
                                                                <img src="{!! Asset(url().'/'.Config('images.avatar_url').$data->Avatar) !!}" class="img-circle img-responsive">
                                                            @endif
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
                                                    <p class="name">{!! $data->FullName !!}</p>
                                                    <p class="des"><i class="glyphicon glyphicon-map-marker"></i> {!! ($data->country)?$data->country->Name:"" !!}</p>
                                                    <p class="location">
                                                        <span class="first">
                                                            @if($data->Gender == 1)
                                                                <i class="fa fa-venus" aria-hidden="true"></i> Male
                                                            @else
                                                                <i class="fa fa-mars" aria-hidden="true"></i> Female
                                                            @endif
                                                        </span>
                                                        <span><i class="glyphicon glyphicon-briefcase"></i>Experience: </span>
                                                        <span><i class="glyphicon glyphicon-time"></i>Updated: {!! $data->updated_at !!}</span>
                                                    </p>
                                                    <div class="tags">
                                                        <ul class="list-tags">
                                                        @if(!empty($data->user->jobseekerskill))
                                                            @foreach ($data->user->jobseekerskill as $val)
                                                                <li class="tag">{!! $val->Name !!}</li>
                                                            @endforeach
                                                        @endif
                                                            
                                                        </ul>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="setInterview" style="display: inline-block; margin-top: 20px; padding: 10px 30px; background: #026dbb; color: #fff; font-size: 16px;cursor: pointer;">
                                                        <i class="fa fa-calendar" aria-hidden="true" style="    margin-right: 5px;"></i> Xét lịch phỏng vấn
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="content-contact">
                                                <div class="col-sm-12">
                                                    <div class="about">
                                                        <span style="background-position: 110px;">Giới thiệu</span>
                                                        <p></p>
                                                    </div>
                                                    <div class="about">
                                                        <span style="background-position: 130px;">Kinh nghiệm</span>
                                                        <ul class="list-ex">
                                                        @if($data->user->jobseeker->experience()->orderBy('id', 'DESC')->get())
                                                            @foreach ($data->user->jobseeker->experience()->orderBy('id', 'DESC')->get() as $item)
                                                                <li class="ex">
                                                                <p class="company-name">{!! $item->CompanyName !!}</p>
                                                                <p class="position">{!! $item->PositionName !!}</p>
                                                                <p class="des">{!! $item->Description !!}</p>
                                                            </li>
                                                            @endforeach
                                                        @endif
                                                            
                                                        </ul>
                                                    </div>
                                                    <div class="about">
                                                        <span>Download cv</span>
                                                        @if($data->CurriculumVitae)
                                                        <a href="{{ Asset(Config('images.url_cv').$data->CurriculumVitae) }}" id="download" download>
                                                            <i class="glyphicon glyphicon-download-alt"></i> Download CV 
                                                        </a>
                                                        @endif
                                                       
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