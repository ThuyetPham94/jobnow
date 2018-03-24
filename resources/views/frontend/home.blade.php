@extends('frontend.main')


@section('content')
	<div class="main"> 
		<div class="company banner margin" style="margin-top:0px;">
			<div class="top-main">
				<div class="banner-about text-center">
					<h2>{!! number_format($count_job) !!} Công việc trong JobNow</h2>
					<p>Việc làm cho Bạn - Bây giờ và Luôn</p>
					<div class="group-button">
						<a href="javascript:void(0)" class="btn btn-default btn-lg btn-sign-up call-register">Đăng ký miễn phí</a>
						<a href="{!! route('public.job.index') !!}" class="btn btn-default btn-lg btn-search">Tìm kiếm</a>
					</div>
				</div>
			</div>
			<div class="center-main">
				<h2><span class="first-title"></span><span class="last-title">Câu chuyện thành công của chúng tôi</span></h2>
				<div class="container">
					<div class="row">
						<div class="col-xs-4 compa text-center">
							<div class="img">
								<img src="{{ asset('frontend/images/icon/find-1.png') }}">
							</div>
							<p class="preview">"Nhờ JobNow Tôi đã có một công việc mà tôi yêu thích hàng ngày." <br /><b>Ứng viên</b></p>
						</div>
						<div class="col-xs-4 info text-center">
							<div class="img">
								<img src="{{ asset('frontend/images/icon/find-2.png') }}">
							</div>
							<p class="preview">"JobNow là một trang web quảng cáo việc làm thân thiện dễ sử dụng, thân thiện với người sử dụng, đã giúp chúng tôi lấp đầy vị trí trống trong tổ chức của chúng tôi. Các tuyển chọn sàng lọc tiên tiến của trang web đã làm cho chúng tôi dễ dàng hơn để sàng lọc đúng ứng viên một cách nhanh chóng." <br /><b>Nhà tuyển dụng</b></p>
						</div>
						<div class="col-xs-4 pro text-center pro">
							<div class="img">
								<img src="{{ asset('frontend/images/icon/find-3.png') }}">
							</div>
							<p class="preview">"JobNow đã làm cho quá trình tuyển dụng của chúng tôi nhanh hơn và hiệu quả hơn. Nó không chỉ làm cho quảng cáo việc làm rẻ hơn, mà còn giúp đạt được một số lượng lớn ứng viên." <br /><b>Employer</b></p>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom-main">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="relation-text">
							<h2>Dành thời gian cho <span class="jobnow">JobNow</span> Bất cứ nơi nào!.</h2>
								<p class="text-dowload">Có sẵn trên Android và iOS.</p>
							</div>							
							<div class="relation-logo row">
								<a href="https://play.google.com/store/apps/details?id=com.newtech.jobnow"><img src="{{ Asset('frontend/images/icon/google-play.png') }}"></a>
								<a href="https://itunes.apple.com/sg/app/job-now/id1185751591?mt=8"><img src="{{ Asset('frontend/images/icon/app-store.png') }}"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop