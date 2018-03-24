<div class="row">
	<div class="col-xs-6 col-sm-3">
		<div class="til-foo">
			jobSeeknSee
		</div>
		<ul class="list">			
			<li><a href="{!! route('public.about') !!}">Về chúng tôi</a></li>			
			<li><a href="{!! route('public.contactus') !!}">Liên hệ</a></li>
			<li><a href="{!! route('public.term') !!}">Điều khoản sử dụng</a></li>
			{{-- <li><a href="">Site Map</a></li> --}}
		</ul>
	</div>
	<div class="col-xs-6 col-sm-3">
		<div class="til-foo">
			Ứng viên
		</div>
		<ul class="list">			
			<li><a href="{!! route('public.job.index') !!}">Tìm việc</a></li>
				<li><a onclick="login()" href="javascript:void(0)">Tải hồ sơ</a></li>			
				<script type="text/javascript">
				function login() {
					@if(isset(Auth::user()->id))
						window.location = "{!! route('public.myprofile.index') !!}";
					@else
						jQuery(document).ready(function() {						
							jQuery('#myModal').modal('show');						
						});	
					@endif					
				}					
				</script>			
			<li><a href="{!! route('public.help') !!}">Trợ giúp</a></li>
			<!-- <li class="call-login"><a href="javascript:void(0)">Login</a></li> -->								
		</ul>
	</div>
	<div class="col-xs-6 col-sm-3">
		<div class="til-foo">
			Nhà tuyển dụng
		</div>
		<ul class="list">			
			<li><a href="{!! url('FindTalent') !!}">Tìm tài năng</a></li>            
            <li><a href="{!! url('PostJob') !!}">Đăng tuyển dụng</a></li>			
			<li><a href="{!! route('public.faqs') !!}">FAQ</a></li>
		</ul>
	</div>
	<div class="col-xs-6 col-sm-3 last-list">
		<div class="til-foo subscribe">
			Trang mạng xã hội
		</div>		
		<div class="social">
			<ul>
				<li style="display: inline;    margin-right: 10px;"><a href="https://www.facebook.com/JobNowApp/" style="color:white;"><i class="fa fa-2x fa-facebook-square" aria-hidden="true"></i></a></li>
				<li  style="display: inline;    margin-right: 10px;"><a href="https://www.linkedin.com/nhome/?trk=" style="color:white;"><i class="fa fa-2x fa-linkedin-square" aria-hidden="true"></i></a></li>
				<li  style="display: inline"><a href="https://www.instagram.com/jobnow.sg/"  style="color:white;"><i class="fa fa-2x fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<div class="download">			
		</div>
	</div>
</div>
