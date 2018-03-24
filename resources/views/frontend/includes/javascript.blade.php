<script src ="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{!! HTML::script('frontend/js/bootstrap-star-rating.js') !!}
{{-- <script type="text/javascript" src="js/bootstrap-star-rating.js"></script> --}}
{!! HTML::script('frontend/js/custom.js') !!}
{!! HTML::script('jquery.validate.min.js') !!}
{!! HTML::script('frontend/js/jquery.masonry.min.js') !!}
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- Modal Login -->

@section('extra-lib')
@show
<div id="popup" style="display: none;z-index: 9999;"> 
	<div id="succes" class="popup" style="height: auto;">
		<div class="left">
		</div>
		<div class="right">
			<p class="mes success"><strong>Thành công !</strong> <span class="pull-right glyphicon glyphicon-remove"></span></p>
			<p class="mes warning"><strong>Cảnh báo !</strong> <span class="pull-right glyphicon glyphicon-remove"></span></p>
			<p class="mes error"><strong>Lỗi !</strong> <span class="pull-right glyphicon glyphicon-remove"></span></p>
			<p class="des_mes"></p>
		</div>
	</div>
</div>
@section('login')

@if(empty(Auth::user()) || !empty(Auth::user()) &&  Auth::user()->IsCompany >= 1)
<div class="modal fade modal-login" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				{!! HTML::image('frontend/images/icon/logo_popup.png') !!}				
				<p><i>Cách tốt nhất để giữ liên lạc với chúng tôi</i></p>
				<a style="display: block;" href="{!! route('public.user.seeker.loginFB') !!}" class="facebook-login"><i class="fa fa-1x fa-facebook" aria-hidden="true"></i> Đăng nhập với facebook <br /><span style="font-size: 13px;"><i>Chúng tôi sẽ không bao giờ đăng bất kỳ nội dung nào nếu không được phép của bạn</i></span></a>
				<h3 class="ui horizontal header divider">
					Hoặc
				</h3>
				{!! Form::open(['url' => route('public.user.seeker.postLoginSeeker'), 'method' => "POST", 'id' => 'form-login']) !!}
					{{ csrf_field() }}
					<div class="form-group">
						<input type="text" class="form-control email-address" id="Email" name="Email" placeholder="Email Address">
					</div>
					<div class="form-group">
						<input type="password" class="form-control pass-login" id="Password" name="Password" placeholder="Mật khẩu">
					</div>
					<div class="form-group">
						<div class="pull-left">
							
							<input class="form-check-input css-checkbox" id="r" type="checkbox" value="1" style="display: none;	" name="Check"> 
							<label for="r" class="form-check-label css-label lite-cyan-check">
								Ghi nhớ
							</label>
						</div>
						<div class="pull-right">
							<a href="javascript:void(0)" class="call-forgot">Quên mật khẩu ?</a>
						</div>
					</div>
					<div class="form-group login-submit">
						<input type="submit" value="Đăng nhập" class="btn btn-primary">
					</div>
				{!! Form::close() !!}
				<p>Nhân viên mới ? <a href="javascript:void(0)" class="call-register">Đăng ký ngay bây giờ</a></p>
				
			</div>
		</div>
	</div>
</div>
<!-- Modal Register -->
<div class="modal fade modal-login" id="myModalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				{!! HTML::image('frontend/images/icon/logo_popup.png') !!}				
				<p><i>Công việc mơ ước của bạn bắt đầu ở đây</i></p>
				<a style="display: block;" href="{!! route('public.user.seeker.loginFB') !!}" class="facebook-login"><i class="fa fa-1x fa-facebook" aria-hidden="true"></i> Đăng ký với facebook <br /><span style="font-size: 13px;"><i>Chúng tôi sẽ không bao giờ đăng bất kỳ nội dung nào nếu không được phép của bạn</i></span></a>
				<h3 class="ui horizontal header divider">
					Or
				</h3>

				{!! Form::open(['url' => route('public.user.seeker.postRegister'), 'method' => 'POST', 'id' => 'form-register']) !!}
					@foreach($errors as $error)
						<p style="text-align: left;color: #cb2424;margin: 0;padding-bottom: 2px;"> (*) {!! $error !!}</p>
					@endforeach
					<div class="form-group" style="text-align: left;">
						<input type="text" class="form-control full-name" id="Fullname" name="FullName" placeholder="Tên đầy đủ" value="{!! old('FullName') !!}">
					</div>
					<div class="form-group" style="text-align: left;">
						<input type="text" class="form-control phone" id="Phone" placeholder="Điện thoại" name="PhoneNumber" value="{!! old('PhoneNumber') !!}">
					</div>
					<div class="form-group" style="text-align: left;">
						<input type="text" class="form-control email-address" id="email" placeholder="Địa chỉ email" name="Email" value="{!! old('Email') !!}">
					</div>
					<div class="form-group" style="text-align: left;">
						<input type="password" class="form-control pass-login" id="password" placeholder="Mật khẩu" name="Password" value="">
					</div>
					<div class="form-group">
						<div class="pull-left">
							<div class="checkbox">
								<input type="checkbox" style="display: none;" id="a" class="css-checkbox" name="Check" value="1">
								<label for="a" class="css-label lite-cyan-check">Gửi email cho tôi cơ hội làm việc.</label>
                               	<label for="a" class="">Tôi đã đọc và đồng ý với điều khoản sử dụng của jobSeeknSee, chính sách bảo mật và sử dụng .</label>
                                                                
							</div>
						</div>
					</div>
					<div class="form-group login-submit">
						<input type="submit" value="Sign Up" class="btn btn-primary">
					</div>
				{!! Form::close() !!}
				<p>Bạn đã có tài khoản rồi? <a href="javascript:void(0)" class="call-login">Đăng nhập ngay</a></p>
			</div>
		</div>
	</div>
</div>
<!-- Modal Fogot Password -->
<div class="modal fade modal-fogot" id="myModalFogot" tabindex="-1" role="dialog" aria-labelledby="myModalFogotLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				{!! Form::open(['url' => route('public.user.seeker.postForgotSeeker'), 'method' => "POST", ]) !!}
					<div class="form-group">
						<input type="text" class="form-control email-address" id="Email" name="Email" placeholder="Địa chỉ email của bạn">
					</div>					
					<div class="form-group login-submit">
						<input type="submit" value="Submit" class="btn btn-primary">
					</div>
				{!! Form::close() !!}
				<p>No account ? <a href="javascript:void(0)" class="call-register">Tạo một tài khoản mới</a></p>
			</div>
		</div>
	</div>
</div>
@show
@endif
<style type="text/css">
	span.error {
		color: red;
	}
</style>
<script type="text/javascript">
	

	jQuery(document).ready(function() {
		// 
		

		@if(session()->has('message'))
			$('.des_mes').text('{!! session()->get('message')  !!}');
			@if(session()->has('status'))
				$('#popup .popup').attr('id', '{!! session()->get('status') !!}');
			@endif
			$('#popup').show();
		@endif
		$('#popup').on('click', function() {
			$('#popup .popup').attr('id','success');
			$(this).hide();
		});
		jQuery('.call-register').click(function(){
			jQuery('#myModal').modal('hide');
			jQuery('#myModalRegister').modal('show');
			jQuery('#myModalFogot').modal('hide');
		});
		jQuery('.call-login').click(function(){
			jQuery('#myModal').modal('show');
			jQuery('#myModalRegister').modal('hide');
		});
		jQuery('.call-forgot').click(function(){
			jQuery('#myModal').modal('hide');
			jQuery('#myModalFogot').modal('show');
		});

		$(document).ready(function() {
            $.validator.addMethod("PHONE", function(value, element) {
                return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
            }, "Phone Number failse.");

            $('#form-login').validate({

                rules : {
                    Email :{
			            required: true,
			            email: true
			        },
                    Password :"required",
                }
            });
            $('#form-register').validate({
            	ignore: ':hidden:not(:checkbox)',
	            	errorPlacement: function (error, element) {
			        if (element.is(":checkbox")) {
			            //	alert('validating')
			            element.closest('.checkbox').append(error)
			        } else {
			            error.insertAfter(element);
			        }
			    },
                rules : {
                    FullName:"required",
					PhoneNumber:"required PHONE",
					Email:{
			            required: true,
			            email: true
			        },
					Password:"required",
                },
                messages: {
                	PhoneNumber: "Please make sure your phone number is together with country code",
                }
            });            
        });

		@if(count($errors))
			jQuery('#myModalRegister').modal('show');
		@endif
	});
</script>
<style type="text/css">
	#Check-error{
	    display: block;
	    text-align: left;
	}
</style>
{{-- {!! dd($errors) !!} --}}