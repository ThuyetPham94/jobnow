
		<div id="top-menu">
			<div class="container">
				@section('top-header')
					@include('frontend.includes.top-header')
				@show
			</div><!-- end .container -->
		</div><!-- end #top-menu -->
		<div class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-md-2 col-sm-4 logo">
								<a href="{!! route('public.home') !!}"><span class="first-logo">job</span><span class="last-logo">now</span></a>
								<h6 style="margin-top: 0px;margin-bottom: 0px;font-size: 13px;width:108%;margin-left: 6px;    color: #337ab7;"><i>Tìm việc mà bạn mơ ước với chúng tôi</i></h6>
							</div>
							@section('main-header')
								<div class="col-md-5 col-sm-8 search">
									@section('search')
										@include('frontend.includes.search')
									@show
								</div>
								<div class="col-md-5 col-sm-12 users">
									@if(empty(Auth::user()) || !empty(Auth::user()) &&  Auth::user()->IsCompany > 0)
										<ul>
											<li class="login call-login"><a href="javascript:void(0)">Đăng nhập</a></li>
											<li class="signup call-register"><a href="javascript:void(0)">Đăng ký</a></li>
									@else
										<ul class="profile-user">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">@if(Auth::user()->IsCompany == 0) {!! Auth::user()->jobseeker->FullName !!} @else {!! (Auth::user()->companyProfile && Auth::user()->companyProfile->Name)?Auth::user()->companyProfile->Name:"Manager" !!} @endif<b class="caret"></b></a>
												<ul class="dropdown-menu dashboard-user">
													<li><a href="{!! asset('MyProfile') !!}">{!! HTML::image('frontend/images/icon/myprofile.png') !!}Thông tin cá nhân</a></li>
													<li><a href="{!! route('public.myprofile.getInterview') !!}">{!! HTML::image('frontend/images/icon/myprofile.png') !!}Phỏng vấn</a>
													</li>
													<li><a href="{!! route('public.myprofile.getAppliedJob') !!}">{!! HTML::image('frontend/images/icon/appjob.png') !!}Việc làm đã ứng tuyển</a></li>
													<li><a href="{!! route('public.myprofile.getSaveJob') !!}">{!! HTML::image('frontend/images/icon/savejob.png') !!}Việc đã lưu</a></li>
													<li><a href="{!! route('public.user.logout') !!}">{!! HTML::image('frontend/images/icon/logout.png') !!} Đăng xuất </a></li>
												</ul>
											</li>
									@endif
										<li class="employers">
											<a href="{!! route('public.company.getLogin') !!}">
												Nhà tuyển dụng
											</a>
										</li>
									</ul>
								</div>
							@show
						</div>
					</div>
				</div>
			</div>
		</div>
		