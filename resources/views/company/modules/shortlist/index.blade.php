@extends('company.main')

@section('extra-style')
<style type="text/css">
    .func a:hover {
        text-decoration: none;
    }
    td{
        vertical-align: middle !important;
    }
    .form-inline1 {
        position: absolute; right: 15px; top: 8px;
    }
    .form-inline1 button {
        border: none; background: none; color: #7d7d7d;
    }
    .form-inline1 input {
        border-right: none;
    }

    .content .top-content img.action:hover{
        cursor: pointer;
    }
    .form-inline1 .input-group-addon{
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
                $( "input[name='Email']" ).val(output.email);
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
    
    $(document).ready(function() {
        @foreach($category as $item)
            $('#example{!! $item->id !!}').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false
    });
    @endforeach
    });</script>

<script type="text/javascript">
    $(document).ready(function () {
    $.validator.addMethod("PHONE", function (value, element) {
    return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
    }, "Phone Number failse.");
    $('#form-interview').validate({
    rules: {
    InterviewDate: 'required',
            ContactName: 'required',
            PhoneNumber: 'required PHONE',
            Location: 'required',
            Subjects: 'required',
            Content: 'required'
    }
    });
    });</script>

    <!-- update by hung -->
    <script type="text/javascript">
        function deleteCategory(id)  {
            var token = '{!! csrf_token() !!}';
            var check = confirm('Are you sure you want to delete?');
            if(check){
                $.ajax({
                    url: '{!! route("public.company.shortlist.delete-shortlist-category") !!}',
                    type: 'POST',
                    data: {id : id, _token : token},
                })
                .done(function(output) {
                    if(output.code == 200) {
                        $('.des_mes').text(output.message);
                        $('#popup .popup').attr('id', 'success');
                        $('#popup').show();
                        $('#category-'+id).hide();
                    }else{
                        $('.des_mes').text(output.message);
                        $('#popup .popup').attr('id', 'error');
                        $('#popup').show();
                    }
                })
            }
            
        }
    </script>
    
    <!-- update category -->
<!--    <script type="text/javascript">
        $(".update-category").click(function(){
            // get category id
            var id_category = $(this).attr("id_category");
            var name = $("#cate-"+id_category).attr("title");
            $("#updateModal").find('input[name="Name"]').val(name);
            $('#updateModal').find('input[name="id"]').val(id_category);
        });
    </script>-->
    <!-- end update by hung -->
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
                    <label>Số điện thoại <span>*</span></label>
                    <input class="form-control" name="PhoneNumber">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Địa điểm <span>*</span></label>
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
                    <p class="text-right">(Nhập tối đa 14500 kys tự)</p>
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
                <div class="col-sm-12 header-main1">
                    <span>Chi tiết danh sách</span>                                                           
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn pull-right" style="margin-left: 20px;">Thêm danh mục</a>                    
                </div>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="create-category">Tạo danh mục</h4>
                            </div>
                            <form action="{!! route('public.company.shortlist.addcateogry') !!}" method="post">
                                <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                                <div class="modal-body">
                                    <div class="form-group">                                    
                                        <label>Danh mục <span> * </span></label>
                                        <input type="text" class="form-control" name="Name" placeholder="Category" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Tạo</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                
                
                <div class="clearfix"></div>
                <div class="content">
                    @if($category->count() > 0)
                    @foreach($category as $item)                                        
                    <!-- update by hung -->
                <div id="updateModal{!! $item->id !!}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="create-category">Cập nhật danh mục</h4>
                            </div>
                            <form action="{!! route('public.company.shortlist.updatecategory') !!}" method="post">
                                <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                                <input type="hidden" value="{!! $item->id !!}" name="id">
                                <div class="modal-body">
                                    <div class="form-group">                                    
                                        <label>Danh mục <span> * </span></label>
                                        <input type="text" class="form-control" name="Name" value="{!! $item->Name !!}" placeholder="Category" required="" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- end update by hung -->                                        
                    <div id="applicatant" class="my-job searchresume">
                        <div id="category-{!! $item->id !!}" class="container-fuild">
                            <div class="border data-search">
                                <div class="top-content" id="cate-{!! $item->id !!}" title="{!! $item->Name !!}" style="position: relative;">
                                    {!! $item->Name !!} <span class="jobnow" style="font-size: 14px; color: #878787;">({!! count($item->Shortlist) !!})</span>
                                    <div class="form-inline1" style="top:0">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <img class="action" href="javascript:void(0)" onclick="deleteCategory({!! $item->id !!})" src="../frontend/jobnow_backend/images/privacy/cancel.png">
                                                <img class="action"   href="javascript:void(0)" data-toggle="modal" data-target="#updateModal{!! $item->id !!}" class="update-category"  src="../frontend/jobnow_backend/images/privacy/shortlist_pen.png">
                                                <button data-toggle="collapse" data-target="#demo{!! $item->id !!}">
                                                    <img src="../frontend/jobnow_backend/images/privacy/shortlist_down.png">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="main-content collapse" id="demo{!! $item->id !!}">
                                    <div class="col-xs-12">
                                        <div class="header-main2" style="padding: 0;">      
                                            <a href="{!! route('public.company.employee.addemployee',['id'=>$item->id]) !!}" style="border: 1.5px solid #036db9;border-radius: 1px;margin-bottom: 10px" class="btn pull-left">
                                                <span style="color: #036db9 "><i class="fa fa-plus" style="padding-right: 10px" aria-hidden="true">                                                    
                                                    </i> Thêm ứng viên</span>
                                            </a>
                                        </div>
                                        @if($item->Shortlist->count() > 0)
                                        <table id="example{!! $item->id !!}" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead style="background-color: #fafafa">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Ảnh</th>
                                                    <th>Tên</th>
                                                    <th>Địa điểm</th>
                                                    <th>Công việc</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item->Shortlist as $item1)
                                                @if($item1->detail->count() >0)
                                                <tr>
                                                    
                                                    <td>{!!$item1->id!!}</td>
                                                    @if($item1->detail['0']->check == 'link')
                                                        <td style="text-align: center;"><img src="{{ $item1->detail['0']->Avatar }}" style="width: 65px" /></td>
                                                    @elseif($item1->detail['0']->check == 'avatar')
                                                        @if(@getimagesize(asset('upload/images/seeker/'.$item1->detail['0']->Avatar)))
                                                        <td style="text-align: center;"><img src="{{ asset('upload/images/seeker/'.$item1->detail['0']->Avatar) }}" style="width: 30%" /></td>
                                                        @else
                                                        <td style="text-align: center;"><img src="{{ asset('upload/images/seeker/btn_locate_profile_not_active.png') }}" style="width: 65px" /></td>
                                                        @endif
                                                    @else
                                                        <td style="text-align: center;"><img src="{{ asset('upload/images/seeker/btn_locate_profile_not_active.png') }}" style="width: 65px" /></td>
                                                    @endif
                                                    <td>{!! $item1->detail['0']->FullName !!}</td>
                                                    <td>{!! $item1->detail['0']->Name !!}</td>
                                                    <td>{!! $item1->Title !!}</td>
                                                    <td>{{ Carbon\Carbon::parse( $item1->created_at)->format('d-m-Y') }}</td>
                                                    <td style="width: 25%">
                                                        <div class="header-main3" style="margin-left: 13px;">      
                                                            <a href="javascript:void(0)" onclick="edit({!! $item1->InterviewID !!})" style="border-radius: 1px" class="btn pull-left">
                                                                <span style="color: #ffffff "><i class="fa fa-calendar" style="padding-right: 10px" aria-hidden="true"></i>Đặt lịch phỏng vấn</span>
                                                            </a>           
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach                                                
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>  
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    @endforeach
                    @endif
                    <div class="clearfix"></div> 
                </div>
            </div>
        </div>
    </div>
</div>
@stop