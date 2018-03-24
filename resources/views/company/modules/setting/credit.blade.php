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
        $('#datetimepicker1').datetimepicker();
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
    function edit() {
        $('#interview').show();
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#form-interview').validate({
            rules: {
                Company: 'required',
                FirstName: 'required',
                LastName: 'required',
                Email: 'required',
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
        <form action="{!! route('public.company.setting.postInvite') !!}" method="POST" id="form-interview">
            <input type="hidden" value="{!! csrf_token() !!}" name="_token">
            <input type="hidden" value="" name="id">
            <div class="head">Lời mời<span onclick="hide()" class="close glyphicon glyphicon-remove"></span></div>   
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Tên công ty </label>
                    <input class="form-control" name="CompanyName">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Họ tên</label>
                    <input class="form-control" name="FirstName">
                </div>
                <div class="col-sm-6">
                    <label>Tên</label>
                    <input class="form-control" name="LastName">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Email </label>
                    <input type="email" class="form-control" name="Email">
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="text-right">
                <input type="reset" class="reset btn" value="RESET">
                <input type="submit" class="send btn" value="Mời ngay">
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
                    <span>THÊM CREDIT</span>                        
                </div>
                
                <div class="clearfix"></div>
                <div class="content">
                    <div id="applicatant" class="my-job searchresume">
                        <div class="container-fuild">

                            <div class="border data-search">                                    
                                <div class="header-main1">                                        
                                    <a href="javascript:void(0)" onclick="edit()" class="btn pull-left" style="margin-left: 20px;">Mời ngay</a>
                                </div>
                                <div class="main-content">                                        
                                    <table class="table table-bordered table-hover">
                                        <thead style="background-color: #fafafa">
                                            <tr>
                                                <th>Họ</th>
                                                <th>Tên</th>
                                                <th>Tên công ty </th>
                                                <th>Email</th>
                                                <th>Trạng thái</th>                                                        
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            @foreach($invite as $item)
                                            <tr>
                                                <td>
                                                    {!! $item->FirstName !!}
                                                </td>
                                                <td>
                                                    {!! $item->LastName !!}
                                                </td>
                                                <td>
                                                    {!! $item->CompanyName !!}
                                                </td>
                                                <td>
                                                    {!! $item->Email !!}
                                                </td>                                                            
                                                <td>
                                                    @if($item->Status ==0 )
                                                    <div class="invited">                                                        
                                                        <span>Đã mời</span>
                                                    </div>
                                                    @elseif($item->Status ==1)
                                                    <div class="invited" style="background-color: #58bf64;border-color:#58bf64 ">                                                        
                                                        <span>Hoàn thành</span>
                                                    </div>
                                                    @else
                                                    <div class="invited" style="background-color: #f3575a;border-color:#f3575a">                                                        
                                                        <span>Từ chối</span>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>                                            

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