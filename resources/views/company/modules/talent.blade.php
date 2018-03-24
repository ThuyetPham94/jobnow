@extends('frontend.main')
@section('main-header')
	<div class="col-md-10 col-sm-10 users">
		<ul>
			<li class="signup"><a href="{!! route('public.company.getCompanyRegister') !!}">Đăng ký</a></li>
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
									<h3><span> Đăng một công việc trên JobNow và tìm được những ứng viên tài năng nhất chỉ trong vài phút.</span></h3>
									<ul class="list-text">
										<li>Với JobNow, việc tìm ứng viên thích hợp cho một vị trí quan trọng trong công ty của bạn là nhanh chóng và dễ dàng.Chỉ cần đăng quảng cáo việc làm của bạn trên JobNow và bắt đầu nhận các đơn ứng tuyển từ các ứng viên tiềm năng ngay lập tức</li>
									</ul>
									<a class="btn read-more" href="{!! route('public.company.getRegister') !!}">Đăng ký ngay</a>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="bg">
									<h3 class="til-form">Đăng nhập với tư cách là <span>Nhà tuyển dụng</span></h3>
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
												<label for="1" name="checkbox2_lbl" class="css-label lite-cyan-check">Nhớ mật khẩu</label>
											    <a class="forgot pull-right"  href="#" data-toggle="modal" data-target="#myModalFogot">Quên mật khẩu ?</a>
										  	</div>
											<button type="submit" class="my-btn">Đăng nhâp</button>
											<p>Bạn là thành viên mới ? <a href="{!! route('public.company.getCompanyRegister') !!}">Đăng ký ngay </a></p>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="working" style="background: url('/public/frontend/images/adf1.png'); padding: 50px 0; text-align: center;">
				<h3 style="margin-bottom: 15px; color: #026dbb;">Tìm kiếm tài năng được thự hiện như thế nào?</h3>
				<p style="max-width: 80%; margin: 0 auto;">Từ trình độ học vấn và kinh nghiệm để phù hợp sở thích và mức lương, bạn có thể nhập nhiều tiêu chí vào công cụ tìm kiếm để có được hồ sơ liên quan nhất.</p>
			</div>
			<div class="bao" style="background: #fff;">
				<div class="container" style="margin-top: 200px;">
					<div class="row">
						<div class="col-sm-6">
							<h4 class="title">Đăng một công việc rất dễ dàng</h4>
							<p>JobNow cung cấp cho bạn một cơ hội chưa từng có để có được quảng cáo công việc của bạn trên một loạt các ứng cử viên tài năng. Chúng tôi nhận được công việc của bạn quảng cáo cho khán giả rộng nhất, giúp bạn đạt được đúng ứng cử viên một cách nhanh chóng và dễ dàng, làm cho quá trình tuyển dụng của bạn hiệu quả hơn.</p>
							<a class="up" href="{!! route('public.company.getRegister') !!}">Đăng ký ngay</a>
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
							<p>Những ứng cử viên tốt nhất không phải luôn luôn tích cực tìm kiếm một công việc. Với JobNow, bạn có thể áp dụng một cách tiếp cận chủ động và tiếp cận các chuyên gia tài năng nhất trước khi đối thủ cạnh tranh của bạn làm.</p>
							<a class="up" href="{!! route('public.company.getRegister') !!}">Đăng ký ngay</a>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<img src="{!! Asset('frontend/images/asdd.png') !!}" style="    top: 50px;">
			</div>
			{{-- <div style="background: #fff; padding: 50px 0; text-align: center;">
				<h2 style="color: #288ccb;">Our Happy Clients Says</h2>
				<p style="max-width: 80%; margin: 50px auto;position: relative;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; top: -30px; left: -70px;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; right: -70px; transform: rotateY(150deg); bottom: -50px">I engage Louis for my web projects since he just started business, my experience so far with him is nothing but great, he can<br />definitely do any customization with ample time given, and delivery of projects is always 100%. He is a sincere person and put his heart into work. Great job!</p>
				<img style="height: 100px; border-radius: 50%; width: 100px; border: 1px solid #ccc; margin-bottom: 10px;" src="{!! Asset('/frontend/images/2937805-a-asia-Young-businessman-posing-Stock-Photo-asia-men-asian.jpg') !!}">
				<p style="text-transform: uppercase; margin-bottom: 5px;"><strong>Mr. Yangvilei</strong></p>
				<p>HR Manager - McDonald’s Singapore</p>
			</div> --}}
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
						<img style="width: 100%;height: 450px"  data-src="holder.js/900x300/auto/#FFF:#FFF" src="{!! Asset('frontend/images/slide.jpg') !!}" data-holder-rendered="true"> 
						<div class="carousel-caption" style="right: 5%; left: 5%;">
							<h2 style="text-shadow: none;color: #288ccb;">Khách hàng của chúng tôi vui vẻ nói</h2>
							<p style="text-shadow: none;color : #000;max-width: 85%; margin: 50px auto;position: relative;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; top: -30px; left: -70px;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; right: -70px; transform: rotateY(150deg); bottom: -50px">“Các bộ lọc tìm kiếm nâng cao của JobNow đã làm cho nhiệm vụ tìm kiếm và xem xét hàng ngàn hồ sơ xin việc ít tẻ nhạt hơn đối với tôi. Đó thực sự là một công cụ rất hữu ích cho các chuyên gia về nhân sự, những người muốn tiết kiệm thời gian duyệt qua các CV và tập trung sự chú ý của họ vào các nhiệm vụ quan trọng hơn.” — Khách hàng</p>
							<img style="height: 100px; border-radius: 50%; width: 100px; border: 1px solid #ccc; margin-bottom: 10px;" src="{!! Asset('/frontend/images/2937805-a-asia-Young-businessman-posing-Stock-Photo-asia-men-asian.jpg') !!}">
							<p style="text-shadow: none;color : #000;text-transform: uppercase; margin-bottom: 5px;"><strong>Mr. Yangvilei</strong></p>
							<p style="text-shadow: none;color : #000">Trưởng phòng Nhân sự - McDonald's Singapore</p>
						</div>
					</div>
					<div class="item">
						<img style="width: 100%;height: 450px"  data-src="holder.js/900x300/auto/#FFF:#FFF" src="{!! Asset('frontend/images/slide.jpg') !!}" data-holder-rendered="true"> 
						<div class="carousel-caption" style="right: 5%; left: 5%;">
							<h2 style="text-shadow: none;color: #288ccb;">Khách hàng của chúng tôi vui vẻ nói</h2>
							<p style="text-shadow: none;color : #000;max-width: 85%; margin: 50px auto;position: relative;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; top: -30px; left: -70px;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; right: -70px; transform: rotateY(150deg); bottom: -50px">“JobNow có hàng ngàn hồ sơ của ứng viên với nền tảng chuyên môn khác nhau và kinh nghiệm. Tôi đã sử dụng trang web để tìm kiếm sơ yếu lý lịch cho tất cả các loại vị trí, từ cấp đầu vào đến quản lý, và nó luôn trả lại kết quả có liên quan nhất.” — Khách hàng</p>
							<img style="height: 100px; border-radius: 50%; width: 100px; border: 1px solid #ccc; margin-bottom: 10px;" src="{!! Asset('/frontend/images/2937805-a-asia-Young-businessman-posing-Stock-Photo-asia-men-asian.jpg') !!}">
							<p style="text-shadow: none;color : #000;text-transform: uppercase; margin-bottom: 5px;"><strong>Mr. Yangvilei</strong></p>
							<p style="text-shadow: none;color : #000">Trưởng phòng Nhân sự - McDonald's Singapore</p>
						</div>
					</div>
					<div class="item">
						<img style="width: 100%;height: 450px"  data-src="holder.js/900x300/auto/#FFF:#FFF" src="{!! Asset('frontend/images/slide.jpg') !!}" data-holder-rendered="true"> 
						<div class="carousel-caption" style="right: 5%; left: 5%;">
							<h2 style="text-shadow: none;color: #288ccb;">Khách hàng của chúng tôi vui vẻ nói</h2>
							<p style="text-shadow: none;color : #000;max-width: 85%; margin: 50px auto;position: relative;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; top: -30px; left: -70px;"><img src="{!! Asset('frontend/images/icon/text.png') !!}" style="position: absolute; right: -70px; transform: rotateY(150deg); bottom: -50px">“Có hai điều làm cho JobNow trở thành sự lựa chọn đúng đắn cho tất cả các loại hình doanh nghiệp Có nghĩa là bạn có thể tiếp cận nhiều ứng viên đáp ứng yêu cầu của bạn và lựa chọn tốt nhất từ họ.” — Khách hàng</p>
							<img style="height: 100px; border-radius: 50%; width: 100px; border: 1px solid #ccc; margin-bottom: 10px;" src="{!! Asset('/frontend/images/2937805-a-asia-Young-businessman-posing-Stock-Photo-asia-men-asian.jpg') !!}">
							<p style="text-shadow: none;color : #000;text-transform: uppercase; margin-bottom: 5px;"><strong>Mr. Yangvilei</strong></p>
							<p style="text-shadow: none;color : #000">Trưởng phòng Nhân sự - McDonald's Singapore</p>
						</div>
					</div>
				</div>
			</div>
			<div class="employer-post text-center" style="padding: 0">
				<div style="background: rgba(30, 30, 31, 0.37); padding: 40px 0;">
					<div class="container">						
						<p class="strong" style="font-size: 30px;">ĐĂNG KÝ NGAY HÔM NAY ĐỂ NHẬN ĐƯỢC NHIỀU ƯU ĐÃI!</p>		
					</div>
				</div>
			</div>
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
							<p>Không có tài khoản ? <a href="javascript:void(0)" class="call-register">Tạo một tài khoản JobNow</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop