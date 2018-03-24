@extends('company.main')

@section('content')

<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span>Nhận nhiều hơn credit</span>
                        {{-- <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Post A Job</a> --}}
                    </div>
                    <div class="clearfix"></div>
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">                                
                                    <div class="border">                                        
                                        <div class="main-content" style="font-family:arial ">
                                            <div class="row">
                                                <div class="col-md-5 col-xs-12 refer" >
                                                    <a class="credit-left" style="text-decoration: none;" href="{!! route('public.company.setting.credit') !!}">
                                                        <img src="../frontend/jobnow_backend/images/privacy/mail.png">
                                                        <p>Vui lòng mời Nhà tuyển dụng mới và nhận được một Tín dụng Việc làm Miễn phí cho mỗi lời mời thành công.</p>
                                                        <img src="../frontend/jobnow_backend/images/privacy/next.png">
                                                    </a>
                                                    <div class="circle">or</div>
                                                </div>                                                
                                                <div class="col-md-7 col-xs-12 buy-credit">
                                                    <p style="font-weight: bold;">Buy Credit</p>        
                                                    <p>Vui lòng xác nhận đây là email chính xác của bạn và chúng tôi sẽ gửi cho bạn thông tin đăng ký JobNow Posting Packages của chúng tôi.</p>
                                                    <form action="{!! route('public.company.postPackage') !!}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="Email" />
                                                        </div>
                                                        <input type="submit" style="width: 100%" class="btn btn-primary" value="Receive Pricing Details">
                                                    </form>
                                                    
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
@stop