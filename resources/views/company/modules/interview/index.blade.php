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
            $.ajax({
            url: '{!! route('public.company.getEditInterviewShortlist') !!}',
            type: 'POST',
                data: {id: id, _token: '{!! csrf_token() !!}'},
            })
            .done(function (output) {
            if(output.code == 500){
                $( "input[name='id']" ).val(id);
                $( "input[name='status_check']" ).val('add');                
                $('#interview').show();               
            }else if (output.code == 200) {                    
                    $( "input[name='id']" ).val(id);
                    $( "input[name='status_check']" ).val('update');                    
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
        
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("PHONE", function(value, element) {
                return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
            }, "Please make sure your phone number is 10 digits together with country code");
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
    </style>
    
    <div id="interview">
    <div class="setinter">
        <form action="{!! route('public.company.editSetInterviewShortlist') !!}" method="POST" id="form-interview">
            <input type="hidden" value="{!! csrf_token() !!}" name="_token">
            <input type="hidden" value="" name="id">
            <input type="hidden" value="" name="status_check">
            <input type="hidden" value="" name="Email">
            <div class="head">Chi tiết phỏng vấn <span onclick="hide()" class="close glyphicon glyphicon-remove"></span></div>
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
                    <label>Số điện thoại<span>*</span></label>
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
                    <label>Tin nhắn <span>*</span></label>
                    <textarea class="form-control" name="Content" rows="8" style="resize: none;"></textarea>
                    <p class="text-right">(Tối đa 14500 ký tự)</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="text-right">
                <input type="reset" class="reset btn" value="Làm mới">
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
                        <span>Chi tiết cuộc phỏng vấn</span>
                        <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="my-job searchresume">
                            <div class="container-fuild">

                                <div class="border data-search">
                                    <div class="top-content" style="position: relative;">
                                        Danh sách phỏng vấn <span class="jobnow" style="font-size: 14px; color: #878787;">( {!! $data->count() !!} )</span>
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="keywork" class="form-control" id="exampleInputAmount" placeholder="Nhập từ khóa" value="{!! old('keywork') !!}">
                                                    <div class="input-group-addon"><button type="submit"><i class="glyphicon glyphicon-search"></i></button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="main-content">
                                        <div class="col-xs-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Tên</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Người phỏng vấn</th>
                                                        <th>Ngày giờ</th>
                                                        <th>trạng thái</th>
                                                        <th>Hành độn</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $item)
                                                        <tr>
                                                            <td>
                                                                <a href="{!! route('public.company.interview.detail',['id'=>$item->user_id]) !!}" class="name">{!! $item->FullName !!}</a>
                                                            </td>
                                                            <td>
                                                                {!! $item->Location !!}
                                                            </td>
                                                            <td>
                                                                {!! $item->ContactName !!}
                                                            </td>
                                                            <td>
                                                                {!! date('d-m-Y', strtotime($item->InterviewDate)) !!} <br />
                                                                {!! $item->Start_time !!} - {!! $item->End_time !!}
                                                            </td>
                                                            <td>
                                                                @if($item->Status == 1)
                                                                    <span class="progres">Đang xử lý</span>
                                                                @elseif($item->Status == 2)
                                                                    <span class="accept">Chấp nhận</span>
                                                                @elseif($item->Status == 4)
                                                                    <span class="reject">Đang chờ xet phỏng vấn</span>
                                                                @else
                                                                    <span class="reject">Từ chối</span>
                                                                @endif
                                                            </td>
                                                            <td class="func">
                                                                <a href="javascript:void(0)" onclick="edit({!! $item->id !!})" class="setInterview" style="display: block;width: 30%;float: left;text-align: center;color: #373737;">
                                                                    <i class="glyphicon glyphicon-edit" style="display: block;margin-bottom: 5px;color: #03A9F4;font-size: 22px;"></i>
                                                                    Cập nhật
                                                                </a>
                                                                <a onclick="rejectInterview{!! $item->id !!}()" style="display: block;width: 30%;float: left;text-align: center;color: #373737;">
                                                                    <i class="fa fa-thumbs-o-down" style="display: block;margin-bottom: 5px;color: red;font-size: 22px;"></i>
                                                                    Từ chối
                                                                </a>
                                                                <a onclick="delInterview{!! $item->id !!}()" style="display: block;width: 30%;float: left;text-align: center;color: #373737;">
                                                                    <i class="glyphicon glyphicon-remove" style="display: block;margin-bottom: 5px;color: red;font-size: 22px;"></i>
                                                                    Xóa
                                                                </a>
                                                            </td>
                                                            <script type="text/javascript">
                                                                function delInterview{!! $item->id !!}() {
                                                                    var r = confirm("Are you sure you want to delete?");
                                                                    if (r == true) {
                                                                        window.location = "{!! route('public.company.delInterview', ['id' => $item->id]) !!}";
                                                                    } 
                                                                }

                                                                function rejectInterview{!! $item->id !!}() {
                                                                    var r = confirm("Are you sure you want to reject?");
                                                                    if (r == true) {
                                                                        window.location = "{!! route('public.company.rejectInterview',['id' => $item->id,'Email'=>$item->Email]) !!}";
                                                                    } 
                                                                }

                                                            </script>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>                                            
                                        </div>  
                                        <div class="clearfix"></div>
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