@extends('company.main')

@section('extra-lib')

<style type="text/css">
    .well{       
        padding: 0;
    }

    .checkout{
        list-style: none;
        margin: 0px; 
        padding: 0;
        border-radius: 0;
    }
    .title{
        padding: 2px;
        text-align: -webkit-center;
        background: radial-gradient(ellipse at center, #f6f8f9 0%,rgb(31, 184, 242) 0%,rgba(36, 160, 236, 0.27) 0%,rgb(44, 153, 233) 100%,#f5f7f9 100%);
        color: #ffffff;
    }
    .checkout li{
        padding: 10px 20px 10px 20px;
        color: #616161;
        font-size: 13px;
        /*//text-shadow: 1px 1px white;*/
        list-style: none;
    }
    .checkout li:last-child{
        text-align: center;
        padding: 15px;
    }
    .checkout li:last-child a{
        border: 1px solid #303030;
        background: -webkit-linear-gradient(top, #525252 0%,#454646 100%);
        padding: 8px;
        color: #ffffff;
        border-radius: 8px;
        text-decoration: none;
    }
    .checkout li:nth-child(even) {background: #EAF2F4}
    .checkout li:nth-child(odd) {background: #FFFFFF}
</style>	
<style type="text/css">
    .error {
        color :red;
    }
</style>
@stop

@section('content')
<div class="main">
    <div >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 header-main">
                    <span>mua tín dụng</span>                        
                </div>
                <div class="clearfix"></div>
                <div class="content">
                    <div class="my-account">                            
                        <div class="container-fuild">                                                            
                                      <div class="row">
                                            <div class="col-sm-3">
                                              <div class="well" style="margin-bottom: 0">
                                                <ul class="checkout">
                                                    <div class="title">
                                                        <h2>CĂN BẢN</h2>
                                                        <h2>$99</h2>
                                                    </div> 
                                                    <li>Được 5 credit</li>    
                                                    <li>Cho phép đăng 5 việc làm</li>
                                                    <li>Đầy đủ các tính năng</li>
                                                    <li>Đăng trong 30 ngày</li>
                                                    <li></li>
                                                    <li></li>
                                                    <li></li>
                                                    <li></li>
                                                    
                                                    <li>
                                                        <form action="{{ url('payment') }}" method="post" role="">
                                                            {{ csrf_field() }}
                                                            <input type="text" name="credit" value="1" hidden="" >
                                                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" style="margin-bottom: 0">
                                            <div class="well">
                                                <ul class="checkout">
                                                    <div class="title">
                                                        <h2>TIÊU CHUẨN</h2>
                                                        <h2>$399.80</h2>
                                                    </div>
                                                    <li>20 credit</li>
                                                    <li>Cho phép đăng 20 việc làm</li>
                                                    <li>Đầy đủ các tính năng</li>
                                                    <li>Mẫu việc làm miễn phí</li>
                                                    <li>Đăng trong 30 ngày</li>
                                                    <li></li>
                                                    <li></li>
                                                    
                                                    
                                                    <li>
                                                        <form action="{{ url('payment') }}" method="post" role="">
                                                            {{ csrf_field() }}
                                                            <input type="text" name="credit" value="2" hidden="" >
                                                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                                                        </form>
                                                    </li>
                                                </ul> 
                                            </div>
                                        </div>
                                        <div class="col-sm-3" style="margin-bottom: 0">
                                            <div class="well">
                                                <ul class="checkout">
                                                    <div class="title">
                                                        <h2>KINH DOANH </h2>
                                                        <h2>$999.50</h2>
                                                    </div>
                                                    <li>50 Credits</li>
                                                    <li>Cho phép đăng 50 việc làm</li>
                                                    <li>Đầy đủ các tính năng</li>
                                                    <li>Mẫu việc làm miễn phí</li>
                                                    <li>Đăng trong 30 ngày</li>
                                                    <li>Giảm giá 5% cho lần đăng ký lại lần 1</li>
                                                    <li>
                                                        <form action="{{ url('payment') }}" method="post" role="">
                                                            {{ csrf_field() }}
                                                            <input type="text" name="credit" value="3" hidden="" >
                                                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" style="margin-bottom: 0">
                                            <div class="well">
                                                <ul class="checkout">
                                                    <div class="title">
                                                        <h2>CAO CẤP </h2>
                                                        <h2>$1999</h2>
                                                    </div>
                                                    <li>100 Credits</li>
                                                    <li>Cho phép đăng 100 việc làm</li>
                                                    <li>Đầy đủ các tính năng</li>
                                                    <li>Mẫu việc làm miễn phí</li>
                                                    <li>Đăng trong 30 ngày</li>
                                                    <li>Giảm giá 10% cho lần đăng ký lại lần 1</li>
                                                    <li>
                                                        <form action="{{ url('payment') }}" method="post" role="">
                                                            {{ csrf_field() }}
                                                            <input type="text" name="credit" value="4" hidden="" >
                                                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div> 
                <div class="clearfix"></div> 
            </div>
        </div>
    </div>
    </div>           
@stop

