@extends('company.main')

@section('extra-style')
<style type="text/css">
    .func a:hover {
        text-decoration: none;
    }
    td{
        vertical-align: middle !important;
    }
    .form-inline {
        position: absolute; right: 15px; top: 8px;
    }
    .form-inline button {
        border: none; background: none; color: #7d7d7d;
    }
    .form-inline input {
        border-right: none;
    }
    .form-inline .input-group-addon{
        background: #fff;
    }
    .accept{
        color: #00BCD4;
    }
    .progres{
        color: #00bf17;
    }
    .reject{
        color: #e20000;
    }
    .cv{
        margin-left: 10px;
        color: red;
        font-weight: bold;
        display: none;
    }

    .ratio{
        @if($seeker->type == 'file' )
            @if(@getimagesize(Asset(Config('images.url').$seeker->Avatar)))
                background-image: url('../../uploads/images/{!! $seeker->Avatar !!}');
            @else
                background-image: url('../../upload/images/seeker/btn_locate_profile_not_active.png');
            @endif
        @elseif($seeker->type == 'link')
            background-image: url('{!! $seeker->Avatar !!}');
        @else
            background-image: url('../../upload/images/seeker/btn_locate_profile_not_active.png');
        @endif
    }
</style>
@stop
@section('initMap')
@stop
@section('extra-lib')
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">

    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#datetimepicker2').datetimepicker({
                    format: 'LT'
                });
        $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
    });
        // $('.setInterview').on('click', function () {
        //     $('#interview').show();
        //     $('body').scrollTop(100);
        // });        
        function hide() {
            $('#interview').hide();
            $('.form-control').val('');
        }
        function hide2() {
           $('#interview2').hide();

       }
        function edit(id) {
            //$('#interview').show();
            
                $.ajax({
            url: '{!! route('public.company.getEditInterviewShortlist') !!}',
            type: 'POST',
            data: {id: id, _token: '{!! csrf_token() !!}'},
            })
            .done(function (output) {
            if(output.code == 500){
                $( "input[name='id']" ).val(id);
                $( "input[name='status_check']" ).val('add');
                $( "input[name='Email']" ).val('email');
                $('#interview').show();               
            }else if (output.code == 200) {                    
                    $( "input[name='id']" ).val(id);
                    $( "input[name='status_check']" ).val('update');
                    $( "input[name='Email']" ).val('email');
                    $( "input[name='InterviewDate']" ).val(output.interview['0'].InterviewDate);
                    $( "input[name='ContactName']" ).val(output.interview['0'].ContactName);
                    $( "input[name='PhoneNumber']" ).val(output.interview['0'].PhoneNumber);
                    $( "input[name='Location']" ).val(output.interview['0'].Location);
                    $( "input[name='Title']" ).val(output.interview['0'].Title);
                    $( "input[name='End_time']" ).val(output.interview['0'].End_time);
                    $( "input[name='Start_time']" ).val(output.interview['0'].Start_time);
                    $( "textarea[name='Content']" ).val(output.interview['0'].Content);
                    $('#datetimepicker1').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });
                $('#interview').show();
                $('body').scrollTop(100);
            } 
            });
            
        }
        function download(link){
            if(link == '' || link == 'None CV'){
                $('.cv').show();
            }else{
                location.href = "{!! route('public.company.interview.downloadCV',['file'=>$seeker->CurriculumVitae]) !!}";
            }
        }
        
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $.validator.addMethod("PHONE", function(value, element) {
            return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
        }, "Phone Number failse.");
        $('#form-interview').validate({
            rules : {
                Company : 'required',
                FirstName : 'required',
                LastName : 'required',
                Email : 'required',
            }
        });
    });
    
    function backlink(){
        window.location = "{{ route('public.company.interview') }}";
    }
    
</script>
<style type="text/css">
    .error {
        color :red;
    }
</style>

<div id="interview">
    <div class="setinter">
        <form action="{!! route('public.company.editSetInterviewShortlist') !!}" method="POST" id="form-interview">
            <input type="hidden" value="{!! csrf_token() !!}" name="_token">
            <input type="hidden" value="" name="id">
            <input type="hidden" value="" name="status_check">
            <input type="hidden" value="" name="Email">
            <div class="head">Chi tiết <span onclick="hide()" class="close glyphicon glyphicon-remove"></span></div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Ngày giờ <span>*</span></label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' name="InterviewDate" class="form-control" />
                        <span class="input-group-addon">
                            <b class="glyphicon glyphicon-calendar"></b>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label>Thời gian bắt đầu</label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' name="Start_time" class="form-control" placeholder="Start time" />
                        <span class="input-group-addon">
                            <b class="glyphicon glyphicon-triangle-bottom"></b>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label>Thời gian kết thúc</label>
                    <div class='input-group date' id='datetimepicker3'>
                        <input type='text' name="End_time" class="form-control" placeholder="End time" />
                        <span class="input-group-addon">
                            <b class="  glyphicon glyphicon-triangle-bottom"></b>
                        </span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Người phỏng vấn <span>*</span></label>
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
                    <label>Vị trí công việc</label>
                    <input class="form-control" name="Title">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Tin nhắn  <span>*</span></label>
                    <textarea class="form-control" name="Content" rows="8" style="resize: none;"></textarea>
                    <p class="text-right">(Tối đa 14500 ký tự)</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="text-right">
                <input type="reset" class="reset btn" value="làm mới">
                <input type="submit" class="send btn" value="Cập nhật">
            </div>
        </form>
    </div>
</div>
@stop

@section('content')
<div class="main">
    <div >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 header-main">
                    <i class="fa fa-arrow-left icon-back" style="color: #298bcc;cursor: pointer" onclick="backlink()" aria-hidden="true"></i><span>XEM LIÊN HỆ</span> 
                    <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Đăng tin</a>
                </div>
                <div class="clearfix"></div>
                <div class="content">
                    <div id="applicatant" class="my-job searchresume">
                        <div class="container-fuild">
                            <div class="border data-search">
                                <div class="top-content">
                                    {!! $seeker->FullName !!}
                                </div> 
                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-2">                                                  
                                            <div style="text-align: center;">
                                                <div  class="ratio img-responsive img-circle"></div>
                                                <div style="margin-top: 10px">
                                                    <i class="glyphicon glyphicon-envelope" style="color: #268ccc;margin-right: 5px;font-size: large;"></i>
                                                    <i class="glyphicon glyphicon-earphone" style="color: #268ccc;margin-left: 5px;font-size: large;"></i>    
                                                </div>

                                            </div>                                              
                                        </div>
                                        <div class="col-md-9">
                                            <div class="container-fluid bg-grey">    
                                                <h4 style="color: #036dbb;font-weight: bold">{!! $seeker->FullName !!}</h4>
                                                <p style="font-weight: bold"><span class="glyphicon glyphicon-map-marker"></span>{!! $seeker->CountryName !!}</p>
                                                <div style="display: flex;">
                                                    <p style="padding-right: 10px"><i style="padding-right: 10px" class="fa fa-transgender" aria-hidden="true"></i>
                                                    @if($seeker->Gender ==0)
                                                        Nữ
                                                    @else
                                                        Nam
                                                    @endif
                                                    </p>|  
                                                    <p style="padding-right: 10px;padding-left: 10px">
                                                        <i class="fa fa-birthday-cake" style="padding-right: 10px" aria-hidden="true"></i> {!! $seeker->year_diff !!} Tuổi</p>|       
                                                    <p style="padding-right: 10px;padding-left: 10px">
                                                        <i class="fa fa-clock-o" style="padding-right: 10px" aria-hidden="true"></i>Cập nhật {!! date('d/m/Y', strtotime($seeker->updated_at))   !!}</p>          
                                                </div>
                                                <div> 
                                                    @foreach($seeker->Skill as $item)
                                                    <p class="tag">{!! $item->Name !!} <i class="fa fa-check" style="color: #016fbc;padding-left: 5px" aria-hidden="true"></i></p>                                                    
                                                    @endforeach
                                                </div>
                                                {{-- <div class="row">                                                   
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="header-main3">      
                                                            <a href="javascript:void(0)" onclick="edit({!! $interview_id !!})" style="border-radius: 1px" class="btn pull-left">
                                                            <span style="color: #ffffff "><i class="fa fa-calendar" style="padding-right: 10px" aria-hidden="true"></i> Set interview time</span></a>
                                                        </div>
                                                    </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="display:-webkit-box;position: relative;margin: 0 15px 15px 15px  ">
                                                <div style="font-weight: bold;font-size: 16px">Giới thiệu</div>
                                                <div class="line" style="position: absolute;top: 10px"></div>
                                            </div>
                                            <p style="font-weight: bold;margin: 0 15px 15px 15px">
                                                {!! $seeker->Description !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="display:-webkit-box;position: relative;margin: 10px 15px 15px 15px">
                                                <div style="font-weight: bold;font-size: 16px">Kinh nghiệm</div>
                                                <div class="line" style="position: absolute;top: 10px"></div>
                                            </div>
                                            @foreach($seeker->Experience as $item)
                                            <div style="display:-webkit-box;margin:10px;">
                                                <div>
                                                    
                                                    <img src="{{ asset('frontend/jobnow_backend/images/privacy/ic_done_inactive.png') }}" style="margin: 10px 0 10px 10px;width: 50%;" />
                                                </div>
                                                <div style="margin: 10px 20px 10px 10px;" >
                                                    <p style="font-weight: bold;">{!! $item->CompanyName !!}</p>
<!--                                                    <p><a href="#" title="">Financial Consultant</a></p>-->
                                                    <p>{!! $item->Description !!}</p>
                                                </div>
                                            </div>  
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12" style="cursor: pointer" onclick="download('{!! $seeker->CurriculumVitae !!}')">
                                            <div style="display:-webkit-box;position: relative;margin: 10px 15px 15px 15px">
                                                <div style="font-weight: bold;font-size: 16px">DOWNLOAD CV</div>
                                                <div class="line" style="position: absolute;top: 10px"></div>
                                            </div>
                                            <div class="cv"> Không có CV </div>
                                            <div class="btn-downloadcv">
                                                <div class="icon-downloadcv">
                                                    <span class="glyphicon glyphicon-download-alt"></span>
                                                </div>
                                                <div>
                                                    <p>Download CV</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div><!-- end .main-content -->
                            </div><!-- end .border -->
                        </div>
                    </div> 
                    <div class="clearfix"></div> 
                </div>
            </div>
        </div>
    </div>
</div>
@stop