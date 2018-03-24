<?php
use App\Models\Job;
?>
@extends('frontend.main')

@section('extra-lib')
	<script type="text/javascript">
		$(document).ready(function() {
            $.validator.addMethod("PHONE", function(value, element) {
                return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
            }, "Phone Number failse.");

            $('#contact').validate({
                rules : {
                    Name:"required",
					PhoneNumber:"required PHONE",
					Email:{
			            required: true,
			            email: true
			        },
					Subject:"required",
					Content:"required"
                }
            });
            
        });
	</script>
@stop

@section('content')
	<div id="wrapper-content">
		<div class="head">
			<p style="text-transform: uppercase">Liên hệ chúng tôi</p>
		</div>
		<div class="container abc" style="margin-top: 30px;">
			<div class="row">
				<div class="col-sm-6">
					<h4 class="title">
						Chúng tôi là ai?
					</h4>
					<p><span class="glyphicon glyphicon-map-marker"></span>Ngõ 147,Triều khúc
					</p>
					<p><span class="glyphicon glyphicon-phone-alt"></span>Điện thoại: 0972781395</p>					
					<p><span class="glyphicon glyphicon-envelope"></span>Email: thuyetphamit@gmail.com</p>
					<p><span class="glyphicon glyphicon-envelope"></span>Liên hệ quảng cáo, email: thuyetphamit@gmail.com</p>
					<p><span class="glyphicon glyphicon-time"></span>Giờ làm việc: 24h tất cả các ngày trong tuần</p>
				</div>

				<div class="col-sm-6">
					<h4 class="title">
						Mẫu điều tra
					</h4>
					<form action="{!! route('public.postContact') !!}" class="row" method="POST" role="form" id="contact">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}"></input>	
						<div class="col-sm-12">
							<div class="form-group">
								<input type="text" class="form-control" name="Name" id="" placeholder="Tên của bạn">
							</div>
						</div>		
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" name="Email" id="" placeholder="Email các bạn">
							</div>
						</div>		
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" name="PhoneNumber" id="" placeholder="Số điện thoại">
							</div>
						</div>		
						<div class="col-sm-12">
							<div class="form-group">
								<input type="text" class="form-control" name="Subject" id="" placeholder="Chủ đề">
							</div>
						</div>		
						<div class="col-sm-12">
							<div class="form-group">
								<textarea rows="8" style="resize: none;" name="Content" class="form-control" id="" placeholder="Tin nhắn"></textarea>
							</div>
						</div>			
						<div class="col-sm-12"><button type="submit" class="btn btn-primary pull-right" style="background: linear-gradient(#3eabf0, #2a8ece); border: none; padding: 8px 25px; border-radius: 2px;">Gửi</button></div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			
	</div>
	<div style="margin-top: 40px">
				<div style="margin-bottom: -5px;">	
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d931.3087902517009!2d105.80025753619964!3d20.98320858283183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa8203fdfd49e8537!2zVHLGsOG7nW5nIFRydW5nIEPhuqVwIEdpYW8gVGjDtG5nIFbhuq1uIFThuqNpIEjDoCBO4buZaQ!5e0!3m2!1svi!2sus!4v1491797890988" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>						
				</div>
			</div>
		</div>
	<style type="text/css">
		.form-control {
			border-radius: 2px !important;
		}
		#wrapper-content {
			background: #fff;
			padding-bottom: 0px;
		}
		#wrapper-content .head{
		    background: url('frontend/images/Business-HD-Backgrounds.jpg') no-repeat left;
		        background-position: 0px -490px;
    background-size: 100%;
		}
		#wrapper-content .head p{
		    margin: 0;
		    padding: 70px 0;
		    text-align: center;
		    color: #fff;
		    font-size: 40px;
		    font-weight: bold;
		    background: rgba(36, 137, 206, 0.34);
		}
		h4.title{
	        color: #2489ce;
		    font-size: 20px;
		    font-weight: bold;
		    margin-bottom: 20px;
		}
		#wrapper-content p{
			
		}
		.bot {
			padding: 50px 0;
		}
		.abc p span{
			    display: inline-block;
    padding: 9px;
    background: #ccc;
    border-radius: 50%;
    margin-right: 10px;
    color: #fff;
    font-size: 12px;
		}
		.abc p:hover span{
			background: #0376c7;
		}
	</style>
@stop