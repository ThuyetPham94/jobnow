@extends('frontend.main')

@section('search')

@stop

@section('content')
	<div class="company company-detail" style="margin-top: 0px;">
		<div class="top-main">
			<div class="profile text-center">
				<h2>Hồ sơ công ty</h2>
				<p>Theo dõi bên trong {!! number_format($total) !!} công ty ở Việt Nam</p>
				<form class="form-inline" action="{!! route('public.company.search') !!}">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="exampleInputAmount" name="keywork" placeholder="Search for a company">
							<div class="input-group-addon"><button type="submit"><i class="glyphicon glyphicon-search"></i><span>Tìm kiếm</span></button></div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="center-main">
			<div class="container">
				<div class="row">
					<div class="text-center text-find">
						<h3><span>Tìm kiếm</span>Hồ sơ công ty</h3>
					</div>
					<div class="col-xs-4 compa text-center">
						<div class="img">
							{!! HTML::image('frontend/images/icon/compa.png') !!}
						</div>
						<h3>Tất cả các công ty</h3>
						<p class="preview">Tìm kiếm thông tin về tất cả các nhà tuyển dụng hàng đầu của Việt Nam và xem tất cả các công việc.</p>
					</div>
					<div class="col-xs-4 info text-center">
						<div class="img">
							{!! HTML::image('frontend/images/icon/info.png') !!}
						</div>
						<h3>Dễ dàng tìm thông tin</h3>
						<p class="preview">Truy cập tất cả các thông tin liên quan một cách nhanh chóng bao gồm địa điểm sử dụng lao động, cách ăn mặc, giờ làm việc và tuyên bố tại sao làm việc với chúng tôi. </p>
					</div>
					<div class="col-xs-4 pro text-center pro">
						<div class="img">
							{!! HTML::image('frontend/images/icon/pro.png') !!}
						</div>
						<h3>Thời gian Xử lý Đơn</h3>
						<p class="preview">Tìm hiểu xem bạn phải chờ đợi bao lâu để đáp lại đơn đăng ký.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom-main">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<div class="relation-text">
							Tìm hiểu xem nó như thế nào để làm việc cho các nhà tuyển dụng nổi bật trong <span>Việt nam</span>
						</div>
						<div class="relation-logo row">
							<ul class="list-logo">
								<li class="col-xs-4 col-sm-2">
									<img class="img-responsive" src="{!! Asset('frontend/images/SB2011_black.png') !!}" img_color = "{!! Asset('frontend/images/SB2011.png') !!}">
								</li>
								<li class="col-xs-4 col-sm-2">
									<img class="img-responsive" src="{!! Asset('frontend/images/Yeos-logo_black.png') !!}" img_color = "{!! Asset('frontend/images/Yeos-logo.png') !!}">
								</li>
								<li class="col-xs-4 col-sm-2">
									<img class="img-responsive" src="{!! Asset('frontend/images/5284779_orig_black.png') !!}" img_color = "{!! Asset('frontend/images/5284779_orig.png') !!}">
								</li>
								<li class="col-xs-4 col-sm-2">
									<img class="img-responsive" src="{!! Asset('frontend/images/Singapore_Airlines_Logo.svg_black.png') !!}" img_color = "{!! Asset('frontend/images/Singapore_Airlines_Logo.svg.png') !!}">
								</li>
								<li class="col-xs-4 col-sm-2">
									<img class="img-responsive" src="{!! Asset('frontend/images/Luxury-Travel-Logo_black.png') !!}" img_color = "{!! Asset('frontend/images/Luxury-Travel-Logo.png') !!}">
								</li>
								<li class="col-xs-4 col-sm-2">
									<img class="img-responsive" src="{!! Asset('frontend/images/starhub-logo_black.png') !!}" img_color = "{!! Asset('frontend/images/starhub-logo.png') !!}">
								</li>
							</ul>
						</div>
						<div class="text-center">
							<a class="btn" href="#">Xem tất cả Công ty</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("ul.list-logo li img").hover(function() {
			var src = $(this).attr('src');
			$(this).attr('src', $(this).attr('img_color'));
			$(this).attr('img_color', src);
		}, function() {
			var src = $(this).attr('src');
			$(this).attr('src', $(this).attr('img_color'));
			$(this).attr('img_color', src);
		});
	});
	</script>
@stop