@extends('frontend.main')
@section('main-header')
	<div class="col-md-10 col-sm-10 users">
		<ul>
			<li class="signup"><a href="{!! route('public.company.getCompanyRegister') !!}">Đăng Ký</a></li>
			<li class="employers">
				<a href="{!! url() !!}">
					Ứng viên
				</a>
			</li>
		</ul>
		<style type="text/css">
			.employers a{
				background: #026dbb;
				color: #fff !important;
				border: none !important;
				padding: 10px 30px !important;
			}
			.signup{
				margin-right: 10px;
			}
			.signup a{
				border: 1px solid #026dbb;
				color: #026dbb !important;
				padding: 10px 15px !important;
			    border-radius: 5px;
			    font-weight: bold;
			}
			.header .main-header .users .signup a{
				border-left: 1px solid #026dbb;
			}
			/* .header .main-header .users ul li>a{
				color: ##026dbb !important;
			} */
			.bao {
				position: relative;
			    padding: 30px 0;
			    min-height: 550px;
			}
			.bao .title{
					font-size: 20px; font-weight: bold; margin-bottom: 25px;
			}
			.bao p{
					margin-bottom: 20px;
			}
			.bao a{
			    max-width: 200px;
			    display: inline-block;
			    background: linear-gradient(#3eabf0, #2a8ece);
			    color: #fff;
			    font-size: 11pt;
			    font-weight: bold;
			    border: none;
			    padding: 10px 30px;
			    text-align: center;
			    color: #fff !important;
			}
			.bao  img{
				position: absolute;
			    max-width: 700px;
			    max-height: 470px;
			}
		</style>
	</div>
@stop
@section('login')
@stop
@section('content')
	<div class="main"> 
		<div class="app employer">
			<div class="employer-top">
				<div style="background: rgba(2, 39, 123, 0.58)	; padding: 60px 0;">
					<div class="container">
						<div class="row">
							<div class="col-xs-6">
								<div class="top-text">
									<h3><span> Đăng một công việc trên JobNow và tìm được những tài năng tốt nhất chỉ trong vài phút.</span></h3>
									<ul class="list-text">
										<li>Với JobNow, việc tìm ứng viên thích hợp cho một vị trí quan trọng trong công ty của bạn là nhanh chóng và dễ dàng.Chỉ cần đăng quảng cáo việc làm của bạn trên JobNow và bắt đầu nhận các ứng dụng từ các ứng viên tiềm năng ngay lập tức</li>
									</ul>
									<a class="btn read-more" href="{!! route('public.company.getRegister') !!}">ĐĂNG KÝ NGAY</a>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="bg">
									<h3 class="til-form">Đăng nhập là <span>Nhà tuyển dụng</span></h3>
									<div class="border-box">
										
										<form action="{!! route('public.company.postLogin') !!}" method="POST" role="form">
											{!! Form::hidden('_token', csrf_token()) !!}
											<div class="form-group">
												<input type="text" class="form-control email" name="Email" placeholder="Email Adress">
											</div>
											<div class="form-group">
												<input type="password" class="form-control password" name="Password" placeholder="Password">
											</div>
											<div class="checkbox">
											    
											    <input type="checkbox" id="1" class="css-checkbox" name="Remember" value="1">
												<label for="1" name="checkbox2_lbl" class="css-label lite-cyan-check">Quên mật khẩu</label>
											    <a class="forgot pull-right" href="#" data-toggle="modal" data-target="#myModalFogot">Quên mật khẩu ?</a>
										  	</div>
											<button type="submit" class="my-btn">Đăng nhập</button>
											<p>Người dùng mới ? <a href="{!! route('public.company.getCompanyRegister') !!}">Đăng ký ngay </a></p>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="working" style="background: url('/public/frontend/images/adf1.png'); padding: 50px 0; text-align: center;">
				<h3 style="margin-bottom: 15px; color: #026dbb;">Tiếp cận hàng nghìn ứng cử viên tích cực</h3>
				<p style="max-width: 80%; margin: 0 auto;">Quảng cáo tuyển dụng trên JobNow và tiếp cận ứng viên bạn không thể tìm thấy ở bất cứ nơi nào khác.</p>
			</div>
			<div class="bao" style="    background: #fff;">
				<div class="container" style="margin-top: 200px;">
					<div class="row">
						<div class="col-sm-6">
							<h4 class="title">Sắp xếp và Xếp hạng Ứng dụng Dễ dàng</h4>
							<p>Sử dụng các lựa chọn kiểm tra tiên tiến của chúng tôi, bạn có thể sắp xếp và xếp hạng ứng dụng dựa trên ngành, kinh nghiệm, giáo dục và một số tiêu chí khác.</p>
							<a class="up" href="{!! route('public.company.getRegister') !!}">ĐĂNG KÝ NGAY</a>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<img src="{!! Asset('frontend/images/apple1.png') !!}" style="top: 50px; right: 0;">
			</div>
			<div class="bao">
				<div class="container" style="margin-top: 200px;">
					<div class="row">
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							<h4 class="title">Tiếp cận Tài năng xuất sắc nhất</h4>
							<p>Xuất bản quảng cáo việc làm của bạn trên JobNow và là người đầu tiên được thông báo về hồ sơ đáp ứng yêu cầu của bạn.</p>
							<a class="up" href="{!! route('public.company.getRegister') !!}">ĐĂNG KÝ NGAY</a>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<img src="{!! Asset('frontend/images/asdd.png') !!}" style="    top: 50px;">
			</div>			
			<div class="carousel slide" id="carousel-example-captions" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-captions" data-slide-to="0" class=""></li>
					<li data-target="#carousel-example-captions" data-slide-to="1" class="active"></li>
					<li data-target="#carousel-example-captions" data-slide-to="2" class=""></li>
				</ol>
				<style type="text/css">
					ol.carousel-indicators li {
					    border: 1px solid #636363;
					}
					ol.carousel-indicators li.active {
				        background-color: #288ccb;
					}
				</style>
				<div class="carousel-inner" role="listbox">
					
					<div class="item active">
						<img style="width: 100%;height: 290px"  data-src="holder.js/900x300/auto/#FFF:#FFF" src="{!! Asset('frontend/images/slide.jpg') !!}" data-holder-rendered="true"> 
						<div class="carousel-caption" style="right: 5%; left: 5%;">
							<h2 style="text-shadow: none;color: #288ccb;">Cần Giúp Viết Viết một Việc Nổi Bật? Hãy để chúng tôi làm điều đó cho bạn!</h2>
							<p style="text-shadow: none;color : #000;max-width: 85%; margin: 50px auto;position: relative;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; top: -30px; left: -70px;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; right: -70px; transform: rotateY(150deg); bottom: -50px">Sự thành công của một đợt tuyển dụng phụ thuộc vào khả năng của bạn để thu hút các ứng cử viên phù hợp và điều này không thể đạt được nếu không có một quảng cáo tuyển dụng tốt và hấp dẫn. Hãy để JobNow giúp bạn tiết kiệm thời gian quý giá dành cho việc viết quảng cáo việc làm và hồ sơ công ty.</p>
						</div>
					</div>
					<div class="item">
						<img style="width: 100%;height: 290px"  data-src="holder.js/900x300/auto/#FFF:#FFF" src="{!! Asset('frontend/images/slide.jpg') !!}" data-holder-rendered="true"> 
						<div class="carousel-caption" style="right: 5%; left: 5%;">
							<h2 style="text-shadow: none;color: #288ccb;">Khách hàng của chúng tôi vui vẻ nói</h2>
							<p style="text-shadow: none;color : #000;max-width: 85%; margin: 50px auto;position: relative;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; top: -30px; left: -70px;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; right: -70px; transform: rotateY(150deg); bottom: -50px">Các chuyên gia của chúng tôi dành thời gian để hiểu về doanh nghiệp của bạn và nhu cầu tuyển dụng độc đáo của bạn và chuẩn bị một quảng cáo việc làm cung cấp thông tin toàn diện về vai trò và yêu cầu trình độ chuyên môn của mình. Ngoài ra, chúng tôi cũng có thể giúp bạn viết một hồ sơ công ty phản ánh thực sự của bạn sức mạnh kinh doanh độc đáo và lợi thế cạnh tranh.</p>							
						</div>
					</div>					
				</div>
			</div>
			<div class="employer-post text-center" style="padding: 0">
				<div style="background: rgba(30, 30, 31, 0.37); padding: 40px 0;">
					<div class="container">
						{{-- <p class="in">For <span>First-Time Customers,</span> we have a special offer to you</p> --}}
						<p class="strong" style="font-size: 30px;">Đăng ký MIỄN PHÍ ngày hôm nay để trải nghiệm đăng tin miễn phí! </p>						
					</div>
				</div>
			</div>
			{{-- forgot password --}}
			<div class="modal fade modal-fogot" id="myModalFogot" tabindex="-1" role="dialog" aria-labelledby="myModalFogotLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							{!! Form::open(['url' => route('public.user.seeker.postForgotSeeker'), 'method' => "POST", ]) !!}
								<div class="form-group">
									<input type="text" class="form-control email-address" id="Email" name="Email" placeholder="Your email Address">
								</div>					
								<div class="form-group login-submit">
									<input type="submit" value="Submit" class="btn btn-primary">
								</div>
							{!! Form::close() !!}
							<p>Bạn chưa có tài khoản ? <a href="javascript:void(0)" class="call-register">Tạo tài khoản mới</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop